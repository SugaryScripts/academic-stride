<?php

namespace App\Livewire;

use Exception;
use Jantinnerezo\LivewireAlert\Facades\LivewireAlert;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Assessment\Exam;
use Illuminate\Support\Facades\Auth;
use App\Models\Attempt\SessionExam as SessionExamModel;

class AvailableExams extends Component {
    use WithPagination;

    public $search = '';
    public $sortColumn = 'title';
    public $sortDirection = 'asc';
    public $perPage = 10;

    protected $queryString = ['search', 'sortColumn', 'sortDirection'];

    public function mount() {
        /*LivewireAlert::title('Success')->success()->show();*/
    }

    public function render() {
        $data = $this->fetchData();

        return view('livewire.available-exam', [
            'data' => $data,
        ])->layout('layouts.app'); // Assuming micro layout for students
    }

    private function fetchData() {
        $user = Auth::user();

        // Get the student's current education level through the User and Student models
        $student = $user->student;

        // If the user is not a student or has no associated education, return an empty collection
        if (!$student || !$student->ref_education_id) {
            return Exam::where('id', null)->paginate($this->perPage)->onEachSide(1);
        }

        return Exam::when($this->search, function ($query, $search) {
            $search = strtolower(trim($search));
            $query->where(function ($query) use ($search) {
                $query->whereRaw('LOWER(title) LIKE ?', ["%{$search}%"])
                    ->orWhereRaw('LOWER(description) LIKE ?', ["%{$search}%"]);
            });
        })
            ->where('ref_education_id', $student->ref_education_id)
            ->orderBy($this->sortColumn, $this->sortDirection)
            ->paginate($this->perPage)
            ->onEachSide(1);
    }

    public function sortBy($column) {
        if ($this->sortColumn === $column) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortColumn = $column;
            $this->sortDirection = 'asc';
        }
        $this->resetPage();
    }

    public function confirmClaimExam($examId) {
        $this->claimExam(['examId' => $examId]);
        /*LivewireAlert::title('Are you sure?')
            ->position('center')
            ->withConfirmButton('Yes, claim it!')
            ->confirmButtonColor('success')
            ->withCancelButton()
            ->onConfirm('claimExam', ['examId' => $examId])
            ->question()
            ->show();*/
        /*$this->alert('warning', , [
            'position' => 'center',
            'showConfirmButton' => true,
            'confirmButtonText' => ,
            'onConfirmed' => 'claimExam',
            'showCancelButton' => true,
            'cancelButtonText' => 'No, cancel!',
            'onDismissed' => null,
            'data' => ['examId' => $examId]
        ]);*/
    }

    public function claimExam($data) {
        $examId = $data['examId'];
        $user = Auth::user();

        // Check if an OPEN or IN_PROGRESS session already exists for this exam and user
        $existingSession = SessionExamModel::where('user_id', $user->id)
            ->where('exam_id', $examId)
            ->whereIn('status', ['OPEN', 'IN_PROGRESS'])
            ->first();

        if ($existingSession) {
            LivewireAlert::info()
                ->title('You already have an active session for this exam!')
                ->position('center')
                ->toast(false)
                ->withConfirmButton()
                ->onConfirm('goToActiveExams')
                ->show();
            /*$this->alert('info', 'You already have an active session for this exam!', [
                'position' => 'center',
                'timer' => 3000,
                'toast' => false,
                'showConfirmButton' => true,
                'confirmButtonText' => 'Go to My Exams',
                'onConfirmed' => 'goToActiveExams'
            ]);*/
            return;
        }

        try {
            // Create a new session exam using the service
            $sessionExam = \App\Services\ExamSessionService::createExamSessionWithQuestions(
                $examId,
                $user->id
            );

            LivewireAlert::success()
                ->title('Exam claimed successfully!')
                ->position('center')
                ->withConfirmButton()
                //->toast(false)
                ->show();
            /*$this->alert('success', 'Exam claimed successfully!', [
                'position' => 'center',
                'timer' => 3000,
                'toast' => false,
                'showConfirmButton' => true,
                'confirmButtonText' => 'Go to My Exams',
                'onConfirmed' => 'goToActiveExams',
            ]);*/

            $this->dispatch('refreshMyExams'); // To refresh the My Exams list

        } catch (Exception $e) {
            LivewireAlert::error()
                ->title('Failed to claim exam')
                ->withConfirmButton()
                ->text($e->getMessage())
                ->toast(false)
                ->show();
            /*$this->alert('error', 'Failed to claim exam: ' . $e->getMessage(), [
                'position' => 'center',
                'timer' => 3000,
                'toast' => false,
                'showConfirmButton' => true,
            ]);*/
        }
    }

    public function goToActiveExams() {
        return redirect()->route('active-exam');
    }
}
