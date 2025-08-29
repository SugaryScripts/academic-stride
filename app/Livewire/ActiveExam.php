<?php

namespace App\Livewire;

use App\Models\Attempt\SessionExam as SessionExamModel;
use Barryvdh\Debugbar\Facades\Debugbar;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

class ActiveExam extends Component {
    use WithPagination, WithoutUrlPagination;

    public string $selectedId = '';
    public $paginate_item = 10, $search, $sortColumn = 'updated_at', $sortDirection = 'desc';

    protected $listeners = [
        'submitted' => '$refresh',
        'refreshMyExams' => '$refresh',
    ];

    public function search() {
        $this->resetPage();
    }

    public function sort($column) {
        $this->sortDirection = $this->sortColumn == $column ? ($this->sortDirection == 'asc' ? 'desc' : 'asc') : 'asc';
        $this->sortColumn = $column;
        $this->alert('info', 'Data tersortir');
    }

    public function render() {
        return view('livewire.students.active-exam', [
            'data' => $this->fetchData(),
        ]);
    }

    private function fetchData() {
        return SessionExamModel::when($this->search, function ($query, $search) {
            $search = strtolower(trim($search));
            $query->where(function ($query) use ($search) {
                $query->whereRaw('LOWER(session_exams.exam_id) LIKE ?', ["%{$search}%"]);
            });
        })
            ->where('user_id' , Auth::user()->id)
            ->where(function ($query) {
                $query->where('status', 'OPEN')
                    ->orWhere('status', 'IN_PROGRESS');
            })
            ->orderBy($this->sortColumn, $this->sortDirection)
            ->paginate($this->paginate_item)->onEachSide(1);
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

    public function onClickStart($id) {
        $sessionExam = SessionExamModel::findOrFail($id);

        if ($sessionExam->status == 'OPEN' || $sessionExam->status == 'IN_PROGRESS') {
            $sessionExam->update([
                'status' => 'IN_PROGRESS',
                'started_at' => Carbon::now(),
            ]);
            $this->redirectRoute('student-exam', ['id' => $id]);
        }
        else
            session()->flash('message', 'Exam must be in OPEN status!');
    }
}
