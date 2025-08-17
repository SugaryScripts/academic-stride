<?php

namespace App\Livewire;

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
    public $timeRemaining = '30:00';
    public $timeRemainingSeconds = 1800;
    /*public $timeRemaining = '1:00';
    public $timeRemainingSeconds = 60;*/
    protected $listeners = [
        'submitted' => '$refresh',
        'timerExpired' => 'submitExam'
    ];
    private $examSession;
    private $sessionQuestions;
    private $userAnswersCache;

    public function mount($id) {
        $this->sessionExamId = $id;
        $this->examSession = \App\Models\Attempt\SessionExam::where('id', $this->sessionExamId)->firstOrFail();

        // Load all session questions with relationships once
        $this->sessionQuestions = SessionQuestion::where('session_exam_id', $this->sessionExamId)
            ->with(['question.answerTextOptions'])
            ->orderBy('question_order')
            ->get();

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
        if (!$this->sessionQuestions) {
            $this->sessionQuestions = SessionQuestion::where('session_exam_id', $this->sessionExamId)
                ->with(['question.answerTextOptions'])
                ->orderBy('question_order')
                ->get();
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

        return view('livewire.student-exam', [
            'currentSessionQuestion' => $currentSessionQuestion,
            'question' => $currentSessionQuestion ? $currentSessionQuestion->question : null,
            'userAnswer' => $this->getUserAnswer($currentSessionQuestion),
            'answeredQuestions' => $this->getAnsweredQuestionsCount(),
            'userAnswers' => $this->getUserAnswers(),
        ])->layout('layouts.exam');
    }

    private function fetchData() {
        if (!$this->sessionQuestions) {
            $this->sessionQuestions = SessionQuestion::where('session_exam_id', $this->sessionExamId)
                ->with(['question.answerTextOptions'])
                ->orderBy('question_order')
                ->get();
        }

        $currentIndex = $this->currentQuestion - 1;
        return $this->sessionQuestions->get($currentIndex);
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
    }

    public function updatedSelectedAnswer() {
        // Auto-save when answer changes
        $this->saveAnswer();
    }

    public function submitExam() {
        if ($this->selectedAnswer) {
            $this->saveAnswer();
        }

        // Update session exam status to finished
        $this->markSessionExamAsFinished();

        // Dispatch event to remove page leave warning
        $this->dispatch('examSubmitted');

        return redirect()->route('recent-exam');
    }

    private function markSessionExamAsFinished() {
        $sessionQuestionIds = SessionQuestion::where('session_exam_id', $this->sessionExamId)
            ->pluck('id');

        $totalQuestions = $sessionQuestionIds->count();
        $correctAnswers = UserAnswerTextOption::whereIn('session_question_id', $sessionQuestionIds)
            ->where('user_id', Auth::id())
            ->where('is_correct', true)
            ->count();
        $finalScore = $totalQuestions > 0 ? round(($correctAnswers / $totalQuestions) * 100, 2) : 0;

        \App\Models\Attempt\SessionExam::where('id', $this->sessionExamId)
            ->update([
                'status' => 'COMPLETED',
                'finished_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'total_score' => (int) $finalScore,
                'percentage_score' => $finalScore,
                'correct_answers' => $correctAnswers
            ]);
    }
}
