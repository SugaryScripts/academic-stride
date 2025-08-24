<?php

namespace Database\Seeders;

use App\Constants\QuestionTypeConstant;
use App\Constants\SessionExamStatusConstant;
use App\Models\Account\User;
use App\Models\Assessment\Exam;
use App\Models\Assessment\ExamSubjectConfiguration;
use App\Models\Assessment\Question;
use App\Models\Attempt\SessionExam;
use App\Models\Attempt\SessionQuestion;
use App\Models\Attempt\UserAnswerTextOption;
use App\Models\MasterType\RefSubject;
use Illuminate\Database\Seeder;

class ExamSessionSeeder extends Seeder
{
    public function run(): void
    {
        // Configure these values as needed
        $userId = 4; // Change to your target user ID
        $subjectId = 3; // Change to your target subject ID
        $questionCount = 20; // Number of questions for the exam

        $user = User::find($userId);
        $subject = RefSubject::find($subjectId);

        if (!$user || !$subject) {
            $this->command->error("User ID {$userId} or Subject ID {$subjectId} not found.");
            return;
        }

        $questions = Question::where('ref_subject_id', $subjectId)->take($questionCount)->get();

        if ($questions->count() < $questionCount) {
            $this->command->warn("Only {$questions->count()} questions available for subject {$subject->name}.");
        }

        // Create exam
        $exam = Exam::create([
            'title' => "Exam {$subject->name} - {$user->name}",
            'created_by' => $userId,
            'ref_education_id' => $user->student->ref_education_id ?? 1,
            'ref_education_code' => $user->student->education->code ?? 'SMA',
            'total_questions' => $questions->count(),
            'is_active' => true,
        ]);

        // Create exam subject configuration
        ExamSubjectConfiguration::create([
            'exam_id' => $exam->id,
            'ref_subject_id' => $subjectId,
            'question_count' => $questions->count(),
        ]);

        // Create session
        $session = SessionExam::create([
            'exam_id' => $exam->id,
            'user_id' => $userId,
            'started_at' => now(),
            'total_questions' => $questions->count(),
            'status' => SessionExamStatusConstant::OPEN,
        ]);

        // Attach questions to session in random order
        foreach ($questions->shuffle() as $index => $question) {
            // Get answer options, shuffle their IDs, and store
            $answerTextOptionIds = $question->answerTextOptions->pluck('id')->shuffle()->toArray();

            SessionQuestion::create([
                'session_exam_id' => $session->id,
                'question_id' => $question->id,
                'question_order' => $index + 1,
                'answer_options_shuffled' => $answerTextOptionIds,
            ]);
        }

        $this->command->info("Exam session created for User ID: {$userId}, Subject ID: {$subjectId}");
    }
}
