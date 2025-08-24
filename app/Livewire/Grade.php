<?php

namespace App\Livewire;

use App\Constants\UserTypeConstant;
use App\Models\Account\User;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

class Grade extends Component {
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
        return view('livewire.grade', [
            'data' => $this->fetchData(),
        ]);
    }

    private function fetchData() {
        return User::when($this->search, function ($query, $search) {
            $search = strtolower(trim($search));
            $query->where(function ($query) use ($search) {
                $query->whereRaw('LOWER(users.name) LIKE ?', ["%{$search}%"]);
            });
        })
            ->where('user_type_code', UserTypeConstant::STUDENT)
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
        $this->redirectRoute('my-grades', ['id' => $hashed]);
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
