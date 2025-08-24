<?php

namespace Database\Seeders;

use App\Services\ExamSessionService;
use App\Constants\QuestionTypeConstant;
use App\Constants\SessionExamStatusConstant;
use App\Constants\UserTypeConstant;
use App\Models\Account\User;
use App\Models\Assessment\Exam;
use App\Models\Assessment\ExamSubjectConfiguration;
use App\Models\Assessment\Question;
use App\Models\Level\Module;
use App\Models\Assessment\AnswerTextOption;
use App\Models\MasterType\RefEducation;
use App\Models\MasterType\RefSubject;
use App\Models\Attempt\SessionExam;
use App\Models\Attempt\SessionQuestion;
use App\Models\Attempt\UserAnswerTextOption;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RealExamTrialSeeder extends Seeder
{
    protected int $trialQuestionCount = 10;
    protected bool $randomizeQuestions = true;

    protected array $subSubjectQuestionCounts = [];
    protected array $parentSubjectQuestionCounts = [];

    public function run(): void
    {
        $this->command->info("Starting RealExamTrialSeeder...");

        // Ensure we have some users for assigning sessions
        $allStudents = User::query()->where('user_type_code', UserTypeConstant::STUDENT)->get();
        if ($allStudents->isEmpty()) {
            $this->command->error("No students found. Please run UserSeeder first.");
            return;
        }

        // Divide students into two halves for different session statuses
        $completedSessionStudents = $allStudents->take(2); // Take 2 students for completed sessions
        $openSessionStudents = $allStudents->slice(2); // The rest for open sessions

        // Fetch education levels
        $educationLevels = RefEducation::all();

        // Collect created exams for assigning sessions
        $createdExams = collect();

        foreach ($educationLevels as $educationLevel) {
            $this->command->info("Processing education level: {$educationLevel->name}");

            $subjects = RefSubject::query()->with('children')->where('ref_education_id', $educationLevel->id)->get();

            if ($subjects->isEmpty()) {
                $this->command->warn("No subjects found for education level {$educationLevel->name}. Skipping.");
                continue;
            }

            foreach ($subjects as $subject) {
                // Only process parent subjects without ref_subject_id (parent_id)
                if ($subject->ref_subject_id !== null) {
                    continue;
                }

                $this->command->info("Creating trial exam for Subject: {$subject->name} in Education Level: {$educationLevel->name}");

                DB::transaction(function () use ($educationLevel, $subject, $createdExams) {
                    $examTitle = "Trial Exam {$subject->name} - {$educationLevel->name}";
                    $questionSourceDescription = $subject->children->isNotEmpty()
                        ? "from combined sub-subjects"
                        : "from {$subject->name}";
                    $examDescription = "Trial exam for {$subject->name} in {$educationLevel->name} with {$this->trialQuestionCount} questions {$questionSourceDescription}.";

                    $questionsForExam = collect();

                    // Get questions for the subject, considering sub-subjects
                    $currentSubjectAndSubSubjects = collect([$subject]);
                    $subSubjects = $subject->children; // Already eager loaded
                    $currentSubjectAndSubSubjects = $currentSubjectAndSubSubjects->merge($subSubjects);

                    $allQuestionsFromRelatedSubjects = collect();
                    foreach ($currentSubjectAndSubSubjects as $s) {
                        $questionsFromDb = Question::with('answerTextOptions')->where('ref_subject_id', $s->id)
                            ->whereHas('subject.education', function ($query) use ($educationLevel) {
                                $query->where('code', $educationLevel->code);
                            })
                            ->get();
                        $allQuestionsFromRelatedSubjects = $allQuestionsFromRelatedSubjects->merge($questionsFromDb);
                    }

                    if ($allQuestionsFromRelatedSubjects->isEmpty()) {
                        $this->command->warn("No questions found for subject {$subject->name} or its sub-subjects. Skipping exam creation.");
                        return; // Exit if no questions found
                    }

                    // Take a fixed number of random questions for the trial exam
                    $countToTake = min($this->trialQuestionCount, $allQuestionsFromRelatedSubjects->count());
                    $questionsForExam = $allQuestionsFromRelatedSubjects->random($countToTake)->shuffle();

                    // Create Exam only if questions are available
                    $exam = Exam::query()->firstOrCreate(
                        [
                            'title' => $examTitle,
                        ],
                        [
                            'description' => $examDescription,
                            'total_questions' => $this->trialQuestionCount,
                            'duration_minutes' => 15, // Trial exams can have a shorter fixed duration
                            'ref_education_code' => $educationLevel->code,
                            'ref_education_id' => $educationLevel->id,
                            'created_by' => User::query()->where('user_type_code', UserTypeConstant::ADMIN)->first()->id ?? User::first()->id,
                            'is_active' => true,
                        ]
                    );

                    // Create ExamSubjectConfiguration for the parent subject
                    $examSubjectConfig = ExamSubjectConfiguration::firstOrCreate(
                        [
                            'exam_id' => $exam->id,
                            'ref_subject_id' => $subject->id,
                        ],
                        [
                            'question_count' => $countToTake, // The number of questions actually taken for this trial exam
                        ]
                    );

                    // Store the created exam along with its attached questions
                    $createdExams->push([
                        'exam' => $exam,
                        'questions' => $questionsForExam,
                        'education_id' => $educationLevel->id,
                    ]);
                });
            }
        }

        $this->command->info("Processing students for completed sessions...");
        $this->processStudents($completedSessionStudents, $createdExams, SessionExamStatusConstant::COMPLETED);

        $this->command->info("Processing students for open sessions...");
        $this->processStudents($openSessionStudents, $createdExams, SessionExamStatusConstant::OPEN);


        $this->command->info("RealExamTrialSeeder finished.");
    }

    protected function processStudents($students, $createdExams, $sessionStatus): void
    {
        foreach ($students as $student) {
            $this->command->info("Processing student: {$student->name} (ID: {$student->id}) for status: {$sessionStatus}");

            // Get student's education level
            // This assumes a 'student' relationship on the User model pointing to a Student model
            $studentEducation = RefEducation::firstWhere('id', $student->student->ref_education_id);

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

                $this->command->info("Creating session for student {$student->name} for exam {$exam->title} with status {$sessionStatus}");

                if ($sessionStatus === SessionExamStatusConstant::COMPLETED) {
                    $startedAt = now()->subHours(6);
                    $finishedAt = $startedAt->addHours(1);

                    $session = SessionExam::create([
                        'exam_id' => $exam->id,
                        'user_id' => $student->id,
                        'started_at' => $startedAt,
                        'finished_at' => $finishedAt,
                        'total_questions' => $exam->total_questions,
                        'status' => $sessionStatus,
                    ]);

                    foreach ($questionsToAttach as $questionIndex => $question) {
                        $answerTextOptionIds = $question->answerTextOptions->pluck('id')->shuffle()->toArray();

                        $sessionQuestion = SessionQuestion::create([
                            'session_exam_id' => $session->id,
                            'question_id' => $question->id,
                            'question_order' => $questionIndex + 1,
                            'answer_options_shuffled' => $answerTextOptionIds,
                        ]);

                        if ($question->ref_question_type_code === QuestionTypeConstant::MULTIPLE_CHOICE_TEXT) {
                            $correctAnswer = $question->answerTextOptions->where('is_correct', true)->first();
                            $allAnswers = $question->answerTextOptions;
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
                } else {
                    ExamSessionService::createExamSessionWithQuestions(
                        $exam->id,
                        $student->id
                    );
                }
            }
        }
    }
}
