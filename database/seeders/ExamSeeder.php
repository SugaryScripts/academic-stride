<?php

namespace Database\Seeders;

use App\Constants\QuestionTypeConstant;
use App\Constants\UserTypeConstant;
use App\Models\Account\User;
use App\Models\Assessment\AnswerTextOption;
use App\Models\Assessment\Exam;
use App\Models\Assessment\ExamSubjectConfiguration;
use App\Models\Assessment\Question;
use App\Models\Attempt\SessionExam;
use App\Models\Attempt\SessionQuestion;
use App\Models\Attempt\UserAnswerTextOption;
use App\Models\MasterType\RefEducation;
use App\Models\MasterType\RefMasterType;
use App\Models\MasterType\RefSubject;
use Illuminate\Database\Seeder;

class ExamSeeder extends Seeder
{
    public function run(): void {
        // Get existing users
        $educators = User::where('user_type_code', UserTypeConstant::EDUCATOR)->get();
        $students = User::where('user_type_code', UserTypeConstant::STUDENT)->get();

        // Get reference data
        $educations = RefEducation::all();
        $subjects = RefSubject::all();

        // Get multiple choice text question type
        $multipleChoiceType = RefMasterType::where('code', QuestionTypeConstant::MULTIPLE_CHOICE_TEXT)->first();

        // Create exams - 2 exams per education level
        $this->command->info("Creating exams...");
        $exams = collect();
        foreach ($educations as $education) {
            $this->command->info("Education {$education->name}");

            for ($examNumber = 1; $examNumber <= 2; $examNumber++) {

                $this->command->info("Educator created by {$educators->random()->id}");
                $exam = Exam::factory()->create([
                    'title' => "Exam {$examNumber} - {$education->name}",
                    'created_by' => $educators->random()->id,
                    'ref_education_id' => $education->id,
                    'ref_education_code' => $education->code,
                    'total_questions' => 40,
                    'is_active' => true,
                ]);
                $exams->push($exam);
                $this->command->info("Created exam");

                // Create subject configurations for each exam (2 or 3 subjects)
                $subjectCount = rand(2, 3);
                $selectedSubjects = $subjects->random($subjectCount);
                $totalQuestions = $exam->total_questions;
                $questionsPerSubject = intval($totalQuestions / $subjectCount);

                foreach ($selectedSubjects as $index => $subject) {
                    $questionCount = $index === $subjectCount - 1
                        ? $totalQuestions - ($questionsPerSubject * ($subjectCount - 1))
                        : $questionsPerSubject;

                    ExamSubjectConfiguration::factory()->create([
                        'exam_id' => $exam->id,
                        'subject_id' => $subject->id,
                        'question_count' => $questionCount,
                    ]);
                }
            }

        }
        $this->command->info("Exam created");

        // Create exam sessions - 4 students per exam
        $sessionStatuses = ['IN_PROGRESS', 'COMPLETED', 'CLOSED', 'OPEN'];

        $this->command->info("Creating exam session...");
        foreach ($exams as $exam) {
            // Select 4 random students for this exam
            $selectedStudents = $students->random(4);

            foreach ($selectedStudents as $index => $student) {
                // Assign different status to each student
                $status = $sessionStatuses[$index % 4];

                $startedAt = fake()->dateTimeBetween('-1 month', 'now');
                $finishedAt = null;

                // Set finished_at for completed sessions
                if ($status === 'COMPLETED') {
                    $finishedAt = fake()->dateTimeBetween($startedAt, 'now');
                }

                $session = SessionExam::factory()->create([
                    'exam_id' => $exam->id,
                    'user_id' => $student->id,
                    'started_at' => $startedAt,
                    'finished_at' => $finishedAt,
                    'total_questions' => $exam->total_questions,
                    'status' => strtoupper($status), // Convert to lowercase to match enum
                ]);

                // Get questions for this exam session
                $availableQuestions = Question::whereIn('ref_subject_id',
                    $exam->subjectConfigurations->pluck('subject_id')
                )->where('is_active', true)->get();

                $selectedQuestions = $availableQuestions->random(
                    min($exam->total_questions, $availableQuestions->count())
                );

                // Create session questions
                foreach ($selectedQuestions as $questionIndex => $question) {
                    $sessionQuestion = SessionQuestion::factory()->create([
                        'session_exam_id' => $session->id,
                        'question_id' => $question->id,
                        'question_order' => $questionIndex + 1,
                    ]);

                    // Create user answers only for COMPLETED sessions
                    if ($status === 'COMPLETED') {
                        $correctAnswer = $question->answerTextOptions->where('is_correct', true)->first();
                        $allAnswers = $question->answerTextOptions;

                        // 70% chance of selecting correct answer
                        $selectedAnswer = rand(1, 100) <= 70 ? $correctAnswer : $allAnswers->random();

                        UserAnswerTextOption::factory()->create([
                            'session_question_id' => $sessionQuestion->id,
                            'user_id' => $student->id,
                            'selected_answer_id' => $selectedAnswer->id,
                            'is_correct' => $selectedAnswer->is_correct,
                        ]);
                    }
                }

                // Update session scores for completed sessions
                if ($status === 'COMPLETED') {
                    $correctAnswers = UserAnswerTextOption::where('user_id', $student->id)
                        ->whereHas('sessionQuestion', function ($query) use ($session) {
                            $query->where('session_exam_id', $session->id);
                        })
                        ->where('is_correct', true)
                        ->count();

                    $session->update([
                        'correct_answers' => $correctAnswers,
                        'total_score' => $correctAnswers * 5, // 5 points per correct answer
                        'percentage_score' => round(($correctAnswers / $session->total_questions) * 100, 2),
                    ]);
                }
            }
        }
        $this->command->info("Exam session created");
    }

}
