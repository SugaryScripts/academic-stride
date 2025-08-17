<?php

use Livewire\Attributes\Layout;
use Livewire\Volt\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

new #[Layout('layouts.app', [
    'page_title' => 'Home'
])]
class extends Component {
    use WithPagination, WithoutUrlPagination;

    public function with(): array
    {
        return [
            'exam' => \App\Models\Assessment\Exam::paginate(10),
        ];
    }
}; ?>

<div>
    //
</div>
