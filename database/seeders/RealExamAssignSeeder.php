<?php

namespace Database\Seeders;

use App\Constants\QuestionTypeConstant;
use App\Constants\SessionExamStatusConstant;
use App\Models\Account\User;
use App\Models\Assessment\Exam;
use App\Models\Attempt\SessionExam;
use App\Models\Attempt\SessionQuestion;
use Illuminate\Database\Seeder;

class RealExamAssignSeeder extends Seeder {
    protected bool $randomizeQuestions = true;

    public function run(): void {
        $this->command->info("Starting RealExamAssignSeeder...");

        $assignments = [
            ['user_id' => 4, 'exam_id' => 1],
            //['user_id' => 5, 'exam_id' => 2],
        ];

        foreach ($assignments as $assignment) {
            $userId = $assignment['user_id'];
            $examId = $assignment['exam_id'];

            $user = User::query()->find($userId);
            $exam = Exam::query()->with('subjectConfigurations.subject.questions')->find($examId);

            if (!$user) {
                $this->command->warn("User with ID {$userId} not found. Skipping assignment.");
                continue;
            }

            if (!$exam) {
                $this->command->warn("Exam with ID {$examId} not found. Skipping assignment for user {$user->name}.");
                continue;
            }

            $questionsToAttach = collect();

            foreach ($exam->subjectConfigurations as $examSubjectConfig) {
                $subjectQuestions = $examSubjectConfig->subject->questions;
                $targetQuestionCount = $examSubjectConfig->question_count;

                $currentQuestionCount = $subjectQuestions->count();
                $childQuestions = collect();

                if ($currentQuestionCount < $targetQuestionCount) {
                    $this->command->info("Duplicating questions for subject {$examSubjectConfig->subject->name} (Current: {$currentQuestionCount}, Target: {$targetQuestionCount})");
                    // Add existing questions
                    $childQuestions = $subjectQuestions;
                    // Duplicate existing questions to meet the target count
                    $needed = $targetQuestionCount - $currentQuestionCount;
                    for ($i = 0; $i < $needed; $i++) {
                        $originalQuestion = $subjectQuestions->random();
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
                    $childQuestions = $subjectQuestions->random($targetQuestionCount);
                }

                if ($this->randomizeQuestions) {
                    $childQuestions = $childQuestions->shuffle();
                }
                $questionsToAttach = $questionsToAttach->merge($childQuestions);
            }

            if ($questionsToAttach->isEmpty()) {
                $this->command->warn("No questions attached for exam: {$exam->title}. Skipping session creation for user {$user->name}.");
                continue;
            }

            // Create an ExamSession for the student and exam
            $startedAt = null;
            $finishedAt = null; // Can be set later if it's an open session, or set to completed if desired

            $session = SessionExam::create([
                'exam_id' => $exam->id,
                'user_id' => $user->id,
                'started_at' => $startedAt,
                'finished_at' => $finishedAt,
                'total_questions' => $exam->total_questions,
                'status' => SessionExamStatusConstant::OPEN, // Default to OPEN, can be configured
            ]);

            // Attach questions to the ExamSession
            foreach ($questionsToAttach as $questionIndex => $question) {
                // Get answer options, shuffle their IDs, and store
                $answerTextOptionIds = $question->answerTextOptions->pluck('id')->shuffle()->toArray();

                SessionQuestion::create([
                    'session_exam_id' => $session->id,
                    'question_id' => $question->id,
                    'question_order' => $questionIndex + 1,
                    'answer_options_shuffled' => $answerTextOptionIds,
                ]);
            }
            $this->command->info("Exam session created for User ID: {$user->id}, Exam ID: {$exam->id} (Title: {$exam->title})");
        }

        $this->command->info("RealExamAssignSeeder finished.");
    }
}
