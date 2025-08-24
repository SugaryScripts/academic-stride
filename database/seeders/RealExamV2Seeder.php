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

class   RealExamV2Seeder extends Seeder {

    protected bool $randomizeQuestions = true; // Toggle for question randomization

    /**
     * Run the database seeds.
     */
    public function run(): void {
        $this->command->info("Starting RealExamV2Seeder...");

        $subSubjectQuestionCounts = [
            'MATH' => 24,
            'IND' => 27,
            'ENG' => 0,
            'IPA-FISIKA' => 21,
            'IPA-KIMIA' => 18,
            'IPA-BIOLOGI' => 24,
            'IPS-SOSIOG' => 15,
            'IPS-GEOGGI' => 27,
            'IPS-EKONMI' => 12,
            'IPS-SEJARH' => 18,
            'IPS-ANTRGI' => 6,
        ];

        // Get reference data
        $educations = RefEducation::all();
        $subjects = RefSubject::with('children')->get(); // Eager load children

        $parentSubjectQuestionCounts = [];

        foreach ($subjects as $parentSubject) {
            if ($parentSubject->children->isNotEmpty()) { // Only process parent subjects
                $totalParentQuestions = 0;
                $parentSubjectChildrenDetails = [];

                foreach ($parentSubject->children as $childSubject) {
                    $questionCount = $subSubjectQuestionCounts[$childSubject->code] ?? 0;
                    if ($questionCount > 0) {
                        $totalParentQuestions += $questionCount;
                        $parentSubjectChildrenDetails[] = [
                            'subject' => $childSubject,
                            'question_count' => $questionCount,
                        ];
                    }
                }

                if ($totalParentQuestions > 0) {
                    $parentSubjectQuestionCounts[$parentSubject->code] = [
                        'subject' => $parentSubject,
                        'total_questions' => $totalParentQuestions,
                        'children_details' => $parentSubjectChildrenDetails,
                    ];
                }
            } else if ($parentSubject->ref_subject_id === null && !in_array($parentSubject->code, ['IPA', 'IPS'])) { // Handle top-level subjects like MATH and IND
                $questionCount = $subSubjectQuestionCounts[$parentSubject->code] ?? 0;
                if ($questionCount > 0) {
                    $parentSubjectQuestionCounts[$parentSubject->code] = [
                        'subject' => $parentSubject,
                        'total_questions' => $questionCount,
                        'children_details' => [[
                                'subject' => $parentSubject,
                                'question_count' => $questionCount,
                            ]],
                    ];
                }
            }
        }

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

        $createdExams = collect();

        // Create exams first, outside the student loop
        $this->command->info("Creating exams for each education level and subject...");
        foreach ($educations as $education) {
            foreach ($parentSubjectQuestionCounts as $parentSubjectCode => $details) {
                $parentSubject = $details['subject'];
                $totalParentQuestions = $details['total_questions'];
                $childrenDetails = collect($details['children_details']);

                // Only process subjects relevant to the education level
                if ($parentSubject->ref_education_id !== $education->id) {
                    continue;
                }

                if ($totalParentQuestions === 0) {
                    $this->command->warn("No questions required for parent subject {$parentSubject->name} ({$parentSubject->code}) for education {$education->name}. Skipping exam creation.");
                    continue;
                }

                $this->command->info("Creating exam for parent subject: {$parentSubject->name} ({$parentSubject->code}) for education level: {$education->name}");

                $examTitle = "Ujian {$parentSubject->name} - {$education->name}";
                $exam = Exam::create([
                    'title' => $examTitle,
                    'created_by' => $educators->random()->id,
                    'ref_education_id' => $education->id,
                    'ref_education_code' => $education->code,
                    'total_questions' => $totalParentQuestions,
                    'is_active' => true,
                ]);

                $questionsToAttach = collect();

                foreach ($childrenDetails as $childDetail) {
                    $childSubject = $childDetail['subject'];
                    $targetQuestionCount = $childDetail['question_count'];

                    $existingQuestions = Question::where('ref_subject_id', $childSubject->id)
                        ->whereHas('subject.education', function ($query) use ($education) {
                            $query->where('code', $education->code);
                        })
                        ->get();

                    if ($existingQuestions->isEmpty()) {
                        $this->command->warn("No questions available for child subject {$childSubject->name} ({$childSubject->code}). Skipping questions for this child in exam {$exam->title}.");
                        continue;
                    }

                    $currentQuestionCount = $existingQuestions->count();
                    $childQuestions = collect();

                    if ($currentQuestionCount < $targetQuestionCount) {
                        $this->command->info("Duplicating questions for {$childSubject->name} (Current: {$currentQuestionCount}, Target: {$targetQuestionCount})");
                        // Add existing questions
                        $childQuestions = $existingQuestions;
                        // Duplicate existing questions to meet the target count
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
                            $childQuestions->push($duplicatedQuestion);
                        }
                    } else {
                        // If enough questions exist, just take the required amount
                        $childQuestions = $existingQuestions->random($targetQuestionCount);
                    }

                    if ($this->randomizeQuestions) {
                        $childQuestions = $childQuestions->shuffle();
                    }
                    $questionsToAttach = $questionsToAttach->merge($childQuestions);
                }

                // If no questions were attached, delete the exam and skip it
                if ($questionsToAttach->isEmpty()) {
                    $this->command->warn("No questions attached to exam: {$exam->title}. Deleting exam and skipping.");
                    $exam->delete();
                    continue;
                }

                // Create ExamSubjectConfiguration for each child subject
                foreach ($childrenDetails as $childDetail) {
                    $childSubject = $childDetail['subject'];
                    $questionCount = $childDetail['question_count'];
                    ExamSubjectConfiguration::create([
                        'exam_id' => $exam->id,
                        'ref_subject_id' => $childSubject->id,
                        'question_count' => $questionCount,
                    ]);
                }

                // Store the created exam along with its attached questions
                $createdExams->push([
                    'exam' => $exam,
                    'questions' => $questionsToAttach,
                    'education_id' => $education->id,
                ]);
            }
        }

        $this->command->info("Processing students for completed sessions...");
        $this->processStudents($completedSessionStudents, $educators, $educations, $createdExams, SessionExamStatusConstant::COMPLETED);

        $this->command->info("Processing students for open sessions...");
        $this->processStudents($openSessionStudents, $educators, $educations, $createdExams, SessionExamStatusConstant::OPEN);

        $this->command->info("RealExamV2Seeder finished.");
    }

    private function processStudents($students, $educators, $educations, $createdExams, $sessionStatus) {
        foreach ($students as $student) {
            $this->command->info("Processing student: {$student->name} (ID: {$student->id}) for status: {$sessionStatus}");

            // Get student's education level
            $studentEducation = $educations->firstWhere('id', $student->student->ref_education_id);

            if (!$studentEducation) {
                $this->command->warn("Student {$student->name} (ID: {$student->id}) has no associated education level. Skipping.");
                continue;
            }

            // Iterate over exams relevant to the student's education level
            $relevantExams = $createdExams->where('education_id', $studentEducation->id);

            if ($relevantExams->isEmpty()) {
                $this->command->warn("No exams found for education level {$studentEducation->name}. Skipping session creation for student {$student->name}.");
                continue;
            }

            foreach ($relevantExams as $examData) {
                $exam = $examData['exam'];
                $questionsToAttach = $examData['questions'];

                $this->command->info("Creating session for student {$student->name} for exam {$exam->title}");

                // Create an ExamSession for the student and exam
                $startedAt = ($sessionStatus === SessionExamStatusConstant::COMPLETED) ? now()->subHours(6) : null;
                $finishedAt = ($sessionStatus === SessionExamStatusConstant::COMPLETED) ? $startedAt->addHours(1) : null;

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
                        'total_score' => $correctAnswers * 5,
                        'percentage_score' => $session->total_questions > 0 ? round(($correctAnswers / $session->total_questions) * 100, 2) : 0,
                    ]);
                }
            }
        }
    }
}
