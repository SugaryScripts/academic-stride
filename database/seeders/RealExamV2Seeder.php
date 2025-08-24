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

class RealExamV2Seeder extends Seeder {

    protected bool $randomizeQuestions = true; // Toggle for question randomization

    /**
     * Run the database seeds.
     */
    public function run(): void {
        $this->command->info("Starting RealExamV2Seeder...");

        $subSubjectQuestionCounts = [
            'MATH' => 98,
            'IND' => 116,
            'ENG' => 0,
            'IPA-FISIKA' => 86,
            'IPA-KIMIA' => 73,
            'IPA-BIOLOGI' => 98,
            'IPS-SOSIOG' => 63,
            'IPS-GEOGGI' => 110,
            'IPS-EKONMI' => 14,
            'IPS-SEJARH' => 20,
            'IPS-ANTRGI' => 8,
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

        $this->command->info("Processing students for completed sessions...");
        $this->processStudents($completedSessionStudents, $educators, $educations, $subjects, $parentSubjectQuestionCounts, SessionExamStatusConstant::COMPLETED);

        $this->command->info("Processing students for open sessions...");
        $this->processStudents($openSessionStudents, $educators, $educations, $subjects, $parentSubjectQuestionCounts, SessionExamStatusConstant::OPEN);

        $this->command->info("RealExamV2Seeder finished.");
    }

    private function processStudents($students, $educators, $educations, $subjects, $parentSubjectQuestionCounts, $sessionStatus) {
        foreach ($students as $student) {
            $this->command->info("Processing student: {$student->name} (ID: {$student->id}) for status: {$sessionStatus}");

            // Get student's education level
            $studentEducation = $educations->firstWhere('id', $student->student->ref_education_id);

            if (!$studentEducation) {
                $this->command->warn("Student {$student->name} (ID: {$student->id}) has no associated education level. Skipping.");
                continue;
            }

            // Iterate over parent subjects (from the pre-calculated $parentSubjectQuestionCounts)
            foreach ($parentSubjectQuestionCounts as $parentSubjectCode => $details) {
                $parentSubject = $details['subject'];
                $totalParentQuestions = $details['total_questions'];
                $childrenDetails = collect($details['children_details']);

                // Only process subjects relevant to the student's education level
                if ($parentSubject->ref_education_id !== $studentEducation->id) {
                    continue;
                }

                if ($totalParentQuestions === 0) {
                    $this->command->warn("No questions required for parent subject {$parentSubject->name} ({$parentSubject->code}). Skipping exam creation.");
                    continue;
                }

                $this->command->info("Creating exam for parent subject: {$parentSubject->name} ({$parentSubject->code}) for student's education level: {$studentEducation->name}");

                // Create an Exam entry for the parent subject
                $examTitle = "Ujian {$parentSubject->name} - {$studentEducation->name}";
                $exam = Exam::create([
                    'title' => $examTitle,
                    'created_by' => $educators->random()->id,
                    'ref_education_id' => $studentEducation->id,
                    'ref_education_code' => $studentEducation->code,
                    'total_questions' => $totalParentQuestions,
                    'is_active' => true,
                ]);

                $questionsToAttach = collect();

                foreach ($childrenDetails as $childDetail) {
                    $childSubject = $childDetail['subject'];
                    $targetQuestionCount = $childDetail['question_count'];

                    // Retrieve existing questions for each child subject and education level
                    $existingQuestions = Question::where('ref_subject_id', $childSubject->id)
                        ->whereHas('subject.education', function ($query) use ($studentEducation) {
                            $query->where('code', $studentEducation->code);
                        })
                        ->get();

                    if ($existingQuestions->isEmpty()) {
                        $this->command->warn("No questions available for child subject {$childSubject->name} ({$childSubject->code}). Skipping questions for this child in exam {$exam->title}.");
                        continue;
                    }

                    $currentQuestionCount = $existingQuestions->count();

                    if ($currentQuestionCount < $targetQuestionCount) {
                        $this->command->info("Duplicating questions for {$childSubject->name} (Current: {$currentQuestionCount}, Target: {$targetQuestionCount})");
                        // Duplicate existing questions to meet the target count
                        $childQuestions = $existingQuestions;
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
                        $questionsToAttach = $questionsToAttach->merge($childQuestions);
                    } else {
                        // If enough questions exist, just take the required amount
                        $selectedQuestions = $existingQuestions->random($targetQuestionCount);
                        if ($this->randomizeQuestions) {
                            $selectedQuestions = $selectedQuestions->shuffle();
                        }
                        $questionsToAttach = $questionsToAttach->merge($selectedQuestions);
                    }
                }

                // If no questions were attached, skip session creation for this exam
                if ($questionsToAttach->isEmpty()) {
                    $this->command->warn("No questions attached to exam: {$exam->title}. Skipping session creation.");
                    $exam->delete(); // Delete the exam if no questions were attached
                    continue;
                }

                // Create ExamSubjectConfiguration for each child subject
                foreach ($childrenDetails as $childDetail) {
                    $childSubject = $childDetail['subject'];
                    $questionCount = $childDetail['question_count'];
                    ExamSubjectConfiguration::create([
                        'exam_id' => $exam->id,
                        'ref_subject_id' => $childSubject->id, // This is still the child subject
                        'question_count' => $questionCount,
                    ]);
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
