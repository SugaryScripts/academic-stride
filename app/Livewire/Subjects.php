<?php

namespace App\Livewire;

use App\Models\MasterType\RefSubject;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

class Subjects extends Component {
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
        return view('livewire.subjects', [
            'data' => $this->fetchData(),
        ]);
    }

    private function fetchData() {
        return RefSubject::when($this->search, function ($query, $search) {
            $search = strtolower(trim($search));
            $query->where(function ($query) use ($search) {
                $query->whereRaw('LOWER(ref_subjects.name) LIKE ?', ["%{$search}%"]);
            });
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
}
