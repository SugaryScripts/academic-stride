<?php

namespace App\Services;

use App\Constants\QuestionTypeConstant;
use App\Constants\SessionExamStatusConstant;
use App\Models\Account\User;
use App\Models\Assessment\Exam;
use App\Models\Assessment\Question;
use App\Models\Attempt\SessionExam;
use App\Models\Attempt\SessionQuestion;
use App\Models\Attempt\UserAnswerTextOption;
use Illuminate\Support\Carbon;

class ExamSessionService
{
    /**
     * Creates an exam session for a student with randomized question and answer order.
     *
     * @param Exam $exam The exam model instance.
     * @param User $student The student user model instance.
     * @param \Illuminate\Support\Collection $questionsToAttach A collection of Question models to attach to the session.
     * @param string $sessionStatus The status of the session (e.g., SessionExamStatusConstant::COMPLETED, SessionExamStatusConstant::OPEN).
     * @return SessionExam The created exam session.
     */
    public static function createExamSessionWithQuestions(
        int $examId,
        int $userId
    ): SessionExam {
        $exam = Exam::with(['subjectConfigurations.subject.children.questions.answerTextOptions', 'subjectConfigurations.subject.questions.answerTextOptions'])
                    ->findOrFail($examId);
        $student = User::findOrFail($userId);

        $questionsToAttach = collect();
        foreach ($exam->subjectConfigurations as $config) {
            $subjectQuestions = $config->subject->questions;
            if ($config->subject->children->isNotEmpty()) {
                foreach ($config->subject->children as $childSubject) {
                    $subjectQuestions = $subjectQuestions->merge($childSubject->questions);
                }
            }
            $questionsToAttach = $questionsToAttach->merge($subjectQuestions->shuffle()->take($config->question_count));
        }

        if ($questionsToAttach->isEmpty()) {
            throw new \Exception("No questions found for exam ID {$examId} from its subjects.");
        }
        // Create an ExamSession for the student and exam
        $session = SessionExam::create([
            'exam_id' => $exam->id,
            'user_id' => $student->id,
            'started_at' => null,
            'finished_at' => null,
            'total_questions' => $exam->total_questions,
            'status' => SessionExamStatusConstant::OPEN,
        ]);

        // Attach questions to the ExamSession
        foreach ($questionsToAttach as $questionIndex => $question) {
            // Get answer options, shuffle their IDs, and store
            $answerTextOptionIds = $question->answerTextOptions->pluck('id')->shuffle()->toArray();

            $sessionQuestion = SessionQuestion::create([
                'session_exam_id' => $session->id,
                'question_id' => $question->id,
                'question_order' => $questionIndex + 1,
                'answer_options_shuffled' => $answerTextOptionIds,
            ]);

        }


        return $session;
    }
}