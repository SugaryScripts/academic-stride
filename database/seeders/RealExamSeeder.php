<?php

namespace Database\Seeders;

use App\Constants\QuestionTypeConstant;
use App\Constants\SessionExamStatusConstant;
use App\Constants\UserTypeConstant;
use App\Models\Account\User;
use App\Models\Assessment\Exam;
use App\Models\Assessment\ExamSubjectConfiguration;
use App\Models\Assessment\Question;
use App\Models\Attempt\SessionExam;
use App\Models\Attempt\SessionQuestion;
use App\Models\Attempt\UserAnswerTextOption;
use App\Models\MasterType\RefEducation;
use App\Models\MasterType\RefSubject;
use Illuminate\Database\Seeder;

class RealExamSeeder extends Seeder {
    /**
     * Run the database seeds.
     */
    public function run(): void {
        $this->command->info("Starting RealExamSeeder...");

        // Define required question counts per subject
        /*$requiredQuestionCounts = [
            'MATH' => 24,
            'IND' => 27,
            'ENG' => 27,
            'IPA' => 63,
            'IPS' => 78,
        ];*/
        $requiredQuestionCounts = [
            //'MATH' => 5,
            'IND' => 20,
            /*'ENG' => 5,*/
            'IPA-FISIKA' => 5,
           // 'IPA-KIMIA' => 5,
            'IPS-SOSIOG' => 20,
            'IPS-GEOGGI' => 15,
            'IPS-EKONMI' => 5,
            'IPS-SEJARH' => 5,
            'IPS-ANTRGI' => 5,
        ];

        // Get reference data
        $educations = RefEducation::all();
        $subjects = RefSubject::all();
        $educators = User::where('user_type_code', UserTypeConstant::EDUCATOR)->get();
        $students = User::where('user_type_code', UserTypeConstant::STUDENT)->get();

        if ($students->isEmpty()) {
            $this->command->warn("No student users found. Skipping exam and session creation.");
            return;
        }

        // Divide students into two halves
        $half = ceil($students->count() / 2);
        $completedSessionStudents = $students->take($half);
        $openSessionStudents = $students->slice($half);

        $this->command->info("Processing students for completed sessions...");
        $this->processStudents($completedSessionStudents, $educators, $educations, $subjects, $requiredQuestionCounts, SessionExamStatusConstant::COMPLETED);

        $this->command->info("Processing students for open sessions...");
        $this->processStudents($openSessionStudents, $educators, $educations, $subjects, $requiredQuestionCounts, SessionExamStatusConstant::OPEN);

        $this->command->info("RealExamSeeder finished.");
    }

    private function processStudents($students, $educators, $educations, $subjects, $requiredQuestionCounts, $sessionStatus) {
        foreach ($students as $student) {
            $this->command->info("Processing student: {$student->name} (ID: {$student->id}) for status: {$sessionStatus}");

            // Get student's education level
            $studentEducation = $educations->firstWhere('id', $student->student->ref_education_id);

            if (!$studentEducation) {
                $this->command->warn("Student {$student->name} (ID: {$student->id}) has no associated education level. Skipping.");
                continue;
            }

            // Get child subjects (subjects without children) relevant to the student's education level
            $relevantSubjects = $subjects->filter(function ($subject) use ($studentEducation) {
                return $subject->ref_education_id === $studentEducation->id && $subject->children()->count() === 0;
            });

            if ($relevantSubjects->isEmpty()) {
                $this->command->warn("No subjects found for education level {$studentEducation->name}. Skipping for student {$student->name}.");
                continue;
            }

            foreach ($relevantSubjects as $subject) {
                $targetQuestionCount = $requiredQuestionCounts[$subject->code] ?? 0;

                if ($targetQuestionCount === 0) {
                    $this->command->warn("No questions required for subject {$subject->name} ({$subject->code}). Skipping exam creation.");
                    continue;
                }

                // Retrieve existing questions for the subject and education level
                $existingQuestions = Question::where('ref_subject_id', $subject->id)
                    ->whereHas('subject.education', function ($query) use ($studentEducation) {
                        $query->where('code', $studentEducation->code);
                    })
                    ->get();

                if ($existingQuestions->isEmpty()) {
                    $this->command->warn("No questions available for subject {$subject->name} ({$subject->code}). Skipping exam creation.");
                    continue;
                }

                $this->command->info("Creating exam for subject: {$subject->name} ({$subject->code}) for student's education level: {$studentEducation->name}");

                // Create an Exam entry for the subject
                $examTitle = "Ujian {$subject->name} - {$studentEducation->name}";
                $exam = Exam::create([
                    'title' => $examTitle,
                    'created_by' => $educators->random()->id,
                    'ref_education_id' => $studentEducation->id,
                    'ref_education_code' => $studentEducation->code,
                    'total_questions' => $targetQuestionCount,
                    'is_active' => true,
                ]);

                // Create ExamSubjectConfiguration
                ExamSubjectConfiguration::create([
                    'exam_id' => $exam->id,
                    'ref_subject_id' => $subject->id,
                    'question_count' => $exam->total_questions,
                ]);

                $questionsToAttach = collect();
                $currentQuestionCount = $existingQuestions->count();

                if ($currentQuestionCount < $targetQuestionCount) {
                    $this->command->info("Duplicating questions for {$subject->name} (Current: {$currentQuestionCount}, Target: {$targetQuestionCount})");
                    // Duplicate existing questions to meet the target count
                    $questionsToAttach = $existingQuestions;
                    $needed = $targetQuestionCount - $currentQuestionCount;
                    for ($i = 0; $i < $needed; $i++) {
                        $originalQuestion = $existingQuestions->random();
                        $duplicatedQuestion = $originalQuestion->replicate();
                        $duplicatedQuestion->created_at = now();
                        $duplicatedQuestion->updated_at = now();
                        $duplicatedQuestion->save();

                        if ($originalQuestion->ref_question_type_code === QuestionTypeConstant::MULTIPLE_CHOICE_TEXT) {
                            foreach ($originalQuestion->answerTextOptions as $option) {
                                $duplicatedOption = $option->replicate();
                                $duplicatedOption->question_id = $duplicatedQuestion->id;
                                $duplicatedOption->created_at = now();
                                $duplicatedOption->updated_at = now();
                                $duplicatedOption->save();
                            }
                        }
                        $questionsToAttach->push($duplicatedQuestion);
                    }
                } else {
                    // If enough questions exist, just take the required amount
                    $questionsToAttach = $existingQuestions->random($targetQuestionCount);
                }

                // Create an ExamSession for the student and exam
                $startedAt = ($sessionStatus === SessionExamStatusConstant::COMPLETED) ? now()->subHours(6) : null;
                $finishedAt = ($sessionStatus === SessionExamStatusConstant::COMPLETED) ? $startedAt->addHours(1) : null; // Example: 2 hours later for completed

                $session = SessionExam::create([
                    'exam_id' => $exam->id,
                    'user_id' => $student->id,
                    'started_at' => $startedAt,
                    'finished_at' => $finishedAt,
                    'total_questions' => $exam->total_questions,
                    'status' => $sessionStatus,
                ]);

                // Attach questions to the ExamSession
                foreach ($questionsToAttach as $questionIndex => $question) {
                    $sessionQuestion = SessionQuestion::create([
                        'session_exam_id' => $session->id,
                        'question_id' => $question->id,
                        'question_order' => $questionIndex + 1,
                    ]);

                    // Create user answers only for COMPLETED sessions
                    if ($sessionStatus === SessionExamStatusConstant::COMPLETED) {
                        if ($question->ref_question_type_code === QuestionTypeConstant::MULTIPLE_CHOICE_TEXT) {
                            $correctAnswer = $question->answerTextOptions->where('is_correct', true)->first();
                            $allAnswers = $question->answerTextOptions;

                            // 70% chance of selecting correct answer
                            $selectedAnswer = rand(1, 100) <= 70 ? $correctAnswer : $allAnswers->random();

                            if ($selectedAnswer) {
                                UserAnswerTextOption::create([
                                    'session_question_id' => $sessionQuestion->id,
                                    'user_id' => $student->id,
                                    'selected_answer_id' => $selectedAnswer->id,
                                    'is_correct' => $selectedAnswer->is_correct,
                                ]);
                            }
                        }
                        // For essay questions in completed sessions, no specific answer option is selected.
                        // The 'is_correct' status for essay questions would typically be determined by manual grading.
                    }
                }

                // Update session scores for completed sessions
                if ($sessionStatus === SessionExamStatusConstant::COMPLETED) {
                    $correctAnswers = UserAnswerTextOption::where('user_id', $student->id)
                        ->whereHas('sessionQuestion', function ($query) use ($session) {
                            $query->where('session_exam_id', $session->id);
                        })
                        ->where('is_correct', true)
                        ->count();

                    $session->update([
                        'correct_answers' => $correctAnswers,
                        'total_score' => $correctAnswers * 5, // 5 points per correct answer
                        'percentage_score' => $session->total_questions > 0 ? round(($correctAnswers / $session->total_questions) * 100, 2) : 0,
                    ]);
                }
            }
        }
    }
}
