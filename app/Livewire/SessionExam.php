<?php

namespace App\Livewire;

use App\Constants\SessionExamStatusConstant;
use Illuminate\Support\Facades\Auth;
use Jantinnerezo\LivewireAlert\Facades\LivewireAlert;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

class SessionExam extends Component {
    use WithPagination, WithoutUrlPagination;

    public string $selectedId = '';
    public $paginate_item = 10, $sortColumn = 'updated_at', $sortDirection = 'desc';
    public $filter_exam_title, $filter_user_name, $filter_started_at_from, $filter_started_at_to, $filter_finished_at_from, $filter_finished_at_to, $filter_correct_answers, $filter_score, $filter_status;

    protected $listeners = [
        'submitted' => '$refresh',
    ];

    public function applyFilter()
    {
        $this->resetPage();
    }

    public function resetFilter()
    {
        $this->filter_exam_title = '';
        $this->filter_user_name = '';
        $this->filter_started_at_from = '';
        $this->filter_started_at_to = '';
        $this->filter_finished_at_from = '';
        $this->filter_finished_at_to = '';
        $this->filter_correct_answers = '';
        $this->filter_score = '';
        $this->filter_status = '';
        $this->resetPage();
    }


    public function sort($column) {
        $this->sortDirection = $this->sortColumn == $column ? ($this->sortDirection == 'asc' ? 'desc' : 'asc') : 'asc';
        $this->sortColumn = $column;
        LivewireAlert::title('Sorted')
            ->info()
            ->toast()
            ->position('top-end')
            ->show();
    }

    public function render() {
        return view('livewire.session-exam', [
            'data' => $this->fetchData(),
        ]);
    }

    private function fetchData() {
        $query = \App\Models\Attempt\SessionExam::query();

        if (Auth::user()->hasAnyRole('Student')){
            $query->where('user_id' , Auth::user()->id);
        }

        $query->when($this->filter_exam_title, function ($query, $exam_title) {
            $query->whereHas('exam', function ($q) use ($exam_title) {
                $q->whereRaw('LOWER(title) LIKE ?', ['%' . strtolower(trim($exam_title)) . '%']);
            });
        })->when($this->filter_user_name, function ($query, $user_name) {
            $query->whereHas('user', function ($q) use ($user_name) {
                $q->whereRaw('LOWER(name) LIKE ?', ['%' . strtolower(trim($user_name)) . '%']);
            });
        })->when($this->filter_started_at_from, function ($query, $started_at_from) {
            $query->whereDate('started_at', '>=', $started_at_from);
        })->when($this->filter_started_at_to, function ($query, $started_at_to) {
            $query->whereDate('started_at', '<=', $started_at_to);
        })->when($this->filter_finished_at_from, function ($query, $finished_at_from) {
            $query->whereDate('finished_at', '>=', $finished_at_from);
        })->when($this->filter_finished_at_to, function ($query, $finished_at_to) {
            $query->whereDate('finished_at', '<=', $finished_at_to);
        })->when($this->filter_correct_answers, function ($query, $correct_answers) {
            $query->where('correct_answers', $correct_answers);
        })->when($this->filter_score, function ($query, $score) {
            $query->where('percentage_score', $score);
        })->when($this->filter_status, function ($query, $status) {
            $query->whereRaw('LOWER(status) LIKE ?', ['%' . strtolower(trim($status)) . '%']);
        });

        if ($this->sortColumn == 'exam.title') {
            $query->join('exams', 'session_exams.exam_id', '=', 'exams.id')
                  ->orderBy('exams.title', $this->sortDirection)
                  ->select('session_exams.*');
        } elseif ($this->sortColumn == 'user.name') {
            $query->join('users', 'session_exams.user_id', '=', 'users.id')
                  ->orderBy('users.name', $this->sortDirection)
                  ->select('session_exams.*');
        } else {
            $query->orderBy($this->sortColumn, $this->sortDirection);
        }

        return $query->paginate($this->paginate_item)->onEachSide(1);
    }

    public function deleteConfirm($id) {
        $this->selectedId = $id;
        /*$this->confirmAlert('warning', 'Apakah Anda yakin?', [
            'text' => 'Data yang terhapus akan hilang selamanya!',
            'timer' => null,
            'toast' => false,
            'position' => 'center',
            'showConfirmButton' => false,
            'showCancelButton' => true,
            'cancelButtonText' => 'Batal',
            'showDenyButton' => true,
            'denyButtonText' => 'Iya, hapus ini!',
            'onDenied' => 'delete',
        ]);*/
    }

    #[On('selectItem')]
    public function selectItem($hashed): void {
        $this->dispatch('getData', $hashed);
        $this->dispatch('showUserModal');
    }

    #[On('delete')]
    public function delete() {
        /*if (app()->environment('demo')) {
            $this->alert('success', 'Data berhasil dihapus!');
        } else { // TODO: need error message
            $this->safeDbOperation(function () {
                $data = User::findByHashedOrFail($this->selectedId);
                $data->delete();

                $this->alert('success', 'Data berhasil dihapus!');
            });
        }*/
    }
}
