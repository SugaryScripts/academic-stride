<?php

namespace App\Livewire;

use App\Models\Attempt\SessionExam as SessionExamModel;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

class RecentExam extends Component {
    use WithPagination, WithoutUrlPagination;

    public string $selectedId = '';
    public $paginate_item = 10, $search, $sortColumn = 'updated_at', $sortDirection = 'desc';

    protected $listeners = [
        'submitted' => '$refresh',
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
        return view('livewire.recent-exam', [
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
            ->where('user_id', Auth::user()->id)
            ->where(function ($query) {
                $query->where('status', 'COMPLETED')
                    ->orWhere('status', 'CLOSED');
            })
            ->orderBy($this->sortColumn, $this->sortDirection)
            ->paginate($this->paginate_item)->onEachSide(1);
    }
}
