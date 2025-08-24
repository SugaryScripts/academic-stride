<?php

namespace App\Livewire\Actions;


use Illuminate\Http\RedirectResponse;

class Index {
    public function __invoke(): RedirectResponse {
        $user = auth()->user();

        if ($user->hasAnyRole('Admin','Educator')) {
            return redirect()->route('homes');
        } elseif ($user->hasAnyRole('Admin','Analyser')) {
            return redirect()->route('homes');
        } elseif ($user->hasAnyRole('Admin','Student')) {
            return redirect()->route('active-exam');
        }

        return redirect()->route('homes'); // fallback
    }
}
