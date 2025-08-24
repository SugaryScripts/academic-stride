<?php

namespace App\Livewire;

use App\Models\Assessment\Exam;
use App\Models\Attempt\SessionExam as SessionExamModel;
use App\Models\Attempt\SessionQuestion;
use App\Models\Attempt\UserAnswerTextOption;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

class StudentExam extends Component {
    use WithPagination, WithoutUrlPagination;

    public $sessionExamId;
    public $selectedAnswer;
    public $currentQuestion;
    public $totalQuestions;
    public $questionUpdatedKey = 0; // Property to trigger Alpine.js re-render
    public $timeRemaining;
    public $timeRemainingSeconds;
    /*public $timeRemaining = '1:00';
    public $timeRemainingSeconds = 60;*/
    protected $listeners = [
        'submitted' => '$refresh',
        'timerExpired' => 'submitExam'
    ];
    public $examSession;
    private $sessionQuestions;
    private $userAnswersCache;

    public function mount($id) {
        $this->sessionExamId = $id;
        $this->examSession = SessionExamModel::with('exam')
            ->where('id', $this->sessionExamId)->firstOrFail();
        // Debug 1: Check initial exam session data
        // dd('Initial examSession:', $this->examSession->toArray());

        // Check if exam is already completed or closed
        if (in_array($this->examSession->status, ['COMPLETED', 'CLOSED'])) {
            return redirect()->route('past-exam'); // Redirect to results or appropriate page
        }

        // 1. Ensure started_at is initialized correctly.
        if (is_null($this->examSession->started_at)) {
            $this->examSession->started_at = Carbon::now();
        }

        // 2. Ensure estimated_finished_at is initialized correctly based on (now guaranteed) started_at.
        if (is_null($this->examSession->estimated_finished_at)) {
            $this->examSession->estimated_finished_at = $this->examSession->started_at->copy()->addMinutes((int) $this->examSession->exam->duration_minutes);
            // After this line, $this->examSession->estimated_finished_at is a Carbon instance.
        }

        // 3. Save any changes made.
        if ($this->examSession->isDirty()) {
            $this->examSession->save();
        }
        
        // Calculate time remaining
        $now = Carbon::now();
        if ($this->examSession->estimated_finished_at->greaterThan($now)) {
            // Time is remaining, calculate positive difference
            $this->timeRemainingSeconds = (int) $now->diffInSeconds($this->examSession->estimated_finished_at);
        } else {
            // Time has passed or is exactly now, no time remaining
            $this->timeRemainingSeconds = 0;
        }

        if ($this->timeRemainingSeconds <= 0) {
            $this->timeRemainingSeconds = 0; // Ensure it's not negative
            $this->submitExam(); // Auto-submit if time has run out
            return; // Exit mount method after submitting
        }

        // Format for display
        $this->timeRemaining = gmdate("i:s", $this->timeRemainingSeconds);


        // Load all session questions with relationships once
        // Eager load answerTextOptions only, do not sort here - sorting will be done in fetchData
        $this->sessionQuestions = SessionQuestion::where('session_exam_id', $this->sessionExamId)
            ->with(['question.answerTextOptions'])
            ->orderBy('question_order')
            ->get();

        // For each session question, ensure answer_options_shuffled is populated
        // This handles cases where old sessions exist or if a new session was created without shuffled answers
        foreach ($this->sessionQuestions as $sessionQuestion) {
            if (empty($sessionQuestion->answer_options_shuffled)) {
                $answerOptionIds = $sessionQuestion->question->answerTextOptions->pluck('id')->shuffle()->toArray();
                $sessionQuestion->update(['answer_options_shuffled' => $answerOptionIds]);
                // Re-fetch the question relationship to get the updated shuffled options
                $sessionQuestion->load('question.answerTextOptions');
            }
        }

        $this->totalQuestions = $this->sessionQuestions->count();
        $this->currentQuestion = $this->getCurrentQuestionNumber();

        // Load all user answers once
        $this->cacheUserAnswers();

        // Set the selected answer for current question
        $this->loadCurrentAnswer();
    }

    private function getCurrentQuestionNumber() {
        return request()->get('page', 1);
    }

    private function cacheUserAnswers() {
        // Ensure sessionQuestions is loaded if not already
        if (!$this->sessionQuestions) {
            $this->sessionQuestions = SessionQuestion::where('session_exam_id', $this->sessionExamId)
                ->with(['question.answerTextOptions'])
                ->orderBy('question_order')
                ->get();
            // Also ensure answer_options_shuffled is populated for these newly loaded questions
            foreach ($this->sessionQuestions as $sessionQuestion) {
                if (empty($sessionQuestion->answer_options_shuffled)) {
                    $answerOptionIds = $sessionQuestion->question->answerTextOptions->pluck('id')->shuffle()->toArray();
                    $sessionQuestion->update(['answer_options_shuffled' => $answerOptionIds]);
                    $sessionQuestion->load('question.answerTextOptions');
                }
            }
        }

        $sessionQuestionIds = $this->sessionQuestions->pluck('id');
        $userAnswers = UserAnswerTextOption::whereIn('session_question_id', $sessionQuestionIds)
            ->where('user_id', Auth::id())
            ->get()
            ->keyBy('session_question_id');

        $this->userAnswersCache = $userAnswers;
    }

    public function render() {
        $currentSessionQuestion = $this->fetchData();

        $question = null;
        if ($currentSessionQuestion && $currentSessionQuestion->question) {
            $question = $currentSessionQuestion->question;
            // Reorder answer options based on the stored shuffled order
            if ($currentSessionQuestion->answer_options_shuffled) {
                $shuffledOrder = $currentSessionQuestion->answer_options_shuffled;
                $question->setRelation('answerTextOptions',
                    $question->answerTextOptions->sortBy(function ($item) use ($shuffledOrder) {
                        return array_search($item->id, $shuffledOrder);
                    })->values()
                );
            }
        }

        return view('livewire.student-exam', [
            'currentSessionQuestion' => $currentSessionQuestion,
            'question' => $question, // Use the reordered question object
            'userAnswer' => $this->getUserAnswer($currentSessionQuestion),
            'answeredQuestions' => $this->getAnsweredQuestionsCount(),
            'userAnswers' => $this->getUserAnswers(),
        ])->layout('layouts.exam');
    }

    private function fetchData() {
        if (!$this->sessionQuestions) {
            // This case should ideally not be hit if mount() runs first, but for robustness
            $this->sessionQuestions = SessionQuestion::where('session_exam_id', $this->sessionExamId)
                ->with(['question.answerTextOptions'])
                ->orderBy('question_order')
                ->get();
        }

        $currentIndex = $this->currentQuestion - 1;
        $currentSessionQuestion = $this->sessionQuestions->get($currentIndex);

        // This check and update is duplicated from mount for robustness
        // In most cases, mount will have already populated it.
        if ($currentSessionQuestion && empty($currentSessionQuestion->answer_options_shuffled)) {
            $answerOptionIds = $currentSessionQuestion->question->answerTextOptions->pluck('id')->shuffle()->toArray();
            $currentSessionQuestion->update(['answer_options_shuffled' => $answerOptionIds]);
            // Re-fetch the question relationship to get the updated shuffled options
            $currentSessionQuestion->load('question.answerTextOptions');
        }

        return $currentSessionQuestion;
    }

    private function loadCurrentAnswer() {
        if (!$this->sessionQuestions) {
            return;
        }

        $currentIndex = $this->currentQuestion - 1;
        $currentSessionQuestion = $this->sessionQuestions->get($currentIndex);

        if ($currentSessionQuestion && $this->userAnswersCache && $this->userAnswersCache->has($currentSessionQuestion->id)) {
            $userAnswer = $this->userAnswersCache->get($currentSessionQuestion->id);
            $this->selectedAnswer = $userAnswer->selected_answer_id;
        } else {
            $this->selectedAnswer = null;
        }
    }

    private function getUserAnswer($sessionQuestion) {
        if (!$sessionQuestion || !$this->userAnswersCache) return null;
        return $this->userAnswersCache->get($sessionQuestion->id);
    }

    private function getAnsweredQuestionsCount() {
        return $this->userAnswersCache ? $this->userAnswersCache->count() : 0;
    }

    private function getUserAnswers() {
        $answeredQuestions = [];
        if (!$this->sessionQuestions || !$this->userAnswersCache) {
            return $answeredQuestions;
        }

        foreach ($this->sessionQuestions as $index => $sessionQuestion) {
            if ($this->userAnswersCache->has($sessionQuestion->id)) {
                $answeredQuestions[$index + 1] = true;
            }
        }
        return $answeredQuestions;
    }

    public function selectAnswer($answerId) {
        $this->selectedAnswer = $answerId;
        $this->saveAnswer();
        $this->questionUpdatedKey++; // Increment to signal Alpine.js to re-render MathJax
    }

    public function saveAnswer() {
        if (!$this->sessionQuestions) {
            $this->sessionQuestions = SessionQuestion::where('session_exam_id', $this->sessionExamId)
                ->with(['question.answerTextOptions'])
                ->orderBy('question_order')
                ->get();
        }

        $currentIndex = $this->currentQuestion - 1;
        $currentSessionQuestion = $this->sessionQuestions->get($currentIndex);

        if (!$currentSessionQuestion || !$this->selectedAnswer) {
            return;
        }

        // Find the correct answer from cached data
        $selectedAnswerOption = $currentSessionQuestion->question
            ->answerTextOptions
            ->firstWhere('id', $this->selectedAnswer);

        $isCorrect = $selectedAnswerOption ? $selectedAnswerOption->is_correct : false;

        $userAnswer = UserAnswerTextOption::updateOrCreate(
            [
                'session_question_id' => $currentSessionQuestion->id,
                'user_id' => Auth::id(),
            ],
            [
                'selected_answer_id' => $this->selectedAnswer,
                'is_correct' => $isCorrect,
            ]
        );

        // Update cache with new answer and refresh to show all answers
        if (!$this->userAnswersCache) {
            $this->userAnswersCache = collect();
        }
        $this->userAnswersCache->put($currentSessionQuestion->id, $userAnswer);
        $this->questionUpdatedKey++; // Increment to signal Alpine.js to re-render MathJax

        // Refresh cache to ensure UI shows all answers correctly
        $this->cacheUserAnswers();
    }

    public function nextQuestion() {
        if ($this->selectedAnswer) {
            $this->saveAnswer();
        }

        if ($this->currentQuestion < $this->totalQuestions) {
            $this->currentQuestion = $this->currentQuestion + 1;
            $this->gotoPage($this->currentQuestion);
            // Refresh cache before loading to ensure we have latest data
            $this->cacheUserAnswers();
            $this->loadCurrentAnswer();
            $this->questionUpdatedKey++; // Increment to signal Alpine.js to re-render MathJax
        }
    }

    public function previousQuestion() {
        if ($this->selectedAnswer) {
            $this->saveAnswer();
        }

        if ($this->currentQuestion > 1) {
            $this->currentQuestion = $this->currentQuestion - 1;
            $this->gotoPage($this->currentQuestion);
            // Refresh cache before loading to ensure we have latest data
            $this->cacheUserAnswers();
            $this->loadCurrentAnswer();
            $this->questionUpdatedKey++; // Increment to signal Alpine.js to re-render MathJax
        }
    }

    public function goToQuestion($questionNumber) {
        if ($this->selectedAnswer) {
            $this->saveAnswer();
        }

        $this->currentQuestion = $questionNumber;
        $this->gotoPage($questionNumber);
        // Refresh cache before loading to ensure we have latest data
        $this->cacheUserAnswers();
        $this->loadCurrentAnswer();
        $this->questionUpdatedKey++; // Increment to signal Alpine.js to re-render MathJax
    }

    public function updatedSelectedAnswer() {
        // Auto-save when answer changes
        $this->saveAnswer();
    }

    public function submitExam() {
        // Ensure any currently selected answer is saved before finalizing
        if ($this->selectedAnswer && $this->currentQuestion) {
            $this->saveAnswer(); // This will increment questionUpdatedKey, but it's okay before redirect
        }

        // Re-fetch the exam session to ensure we have the latest data, especially estimated_finished_at
        $this->examSession->refresh();

        // Determine the actual finished_at time
        $now = Carbon::now();
        $finishedAt = ($now->greaterThan($this->examSession->estimated_finished_at))
            ? $this->examSession->estimated_finished_at
            : $now;

        // Perform final scoring and update session exam status
        $sessionQuestionIds = SessionQuestion::where('session_exam_id', $this->sessionExamId)
            ->pluck('id');

        $totalQuestions = $sessionQuestionIds->count();
        $correctAnswers = UserAnswerTextOption::whereIn('session_question_id', $sessionQuestionIds)
            ->where('user_id', Auth::id())
            ->where('is_correct', true)
            ->count();
        $finalScore = $totalQuestions > 0 ? round(($correctAnswers / $totalQuestions) * 100, 2) : 0;

        SessionExamModel::where('id', $this->sessionExamId)
            ->update([
                'status' => 'COMPLETED',
                'finished_at' => $finishedAt, // Use the determined finishedAt
                'updated_at' => Carbon::now(),
                'total_score' => (int) $finalScore,
                'percentage_score' => $finalScore,
                'correct_answers' => $correctAnswers
            ]);

        // Dispatch event to remove client-side timer (if still running)
        $this->dispatch('examSubmitted');

        return redirect()->route('past-exam');
    }
}
