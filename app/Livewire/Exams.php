<?php

namespace App\Livewire;

use App\Models\Assessment\Exam;
use Jantinnerezo\LivewireAlert\Facades\LivewireAlert;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

class Exams extends Component {
    use WithPagination, WithoutUrlPagination;

    public string $selectedId = '';
    public $paginate_item = 10, $sortColumn = 'updated_at', $sortDirection = 'desc';
    public $filter_title, $filter_total_question, $filter_duration, $filter_education, $filter_created_by;

    protected $listeners = [
        'submitted' => '$refresh',
    ];

    public function applyFilter()
    {
        $this->resetPage();
    }

    public function resetFilter()
    {
        $this->filter_title = '';
        $this->filter_total_question = '';
        $this->filter_duration = '';
        $this->filter_education = '';
        $this->filter_created_by = '';
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
        return view('livewire.exams', [
            'data' => $this->fetchData(),
        ]);
    }

    private function fetchData() {
        $query = Exam::query();

        $query->when($this->filter_title, function ($query, $title) {
            $query->whereRaw('LOWER(title) LIKE ?', ['%' . strtolower(trim($title)) . '%']);
        })->when($this->filter_total_question, function ($query, $total_questions) {
            $query->where('total_questions', $total_questions);
        })->when($this->filter_duration, function ($query, $duration) {
            $query->where('duration_minutes', $duration);
        })->when($this->filter_education, function ($query, $education) {
            $query->whereRaw('LOWER(ref_education_code) LIKE ?', ['%' . strtolower(trim($education)) . '%']);
        })->when($this->filter_created_by, function ($query, $created_by) {
            $query->whereHas('creator', function ($q) use ($created_by) {
                $q->whereRaw('LOWER(name) LIKE ?', ['%' . strtolower(trim($created_by)) . '%']);
            });
        });

        if ($this->sortColumn == 'creator.name') {
            $query->join('users', 'exams.created_by', '=', 'users.id')
                  ->orderBy('users.name', $this->sortDirection)
                  ->select('exams.*'); // Select exams.* to avoid column ambiguity
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
        LivewireAlert::title('Changes saved!')
            ->success()
            ->show();
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
