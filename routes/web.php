<?php

use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;


Route::middleware('auth')->group(function () {

    Route::get('/', \App\Livewire\Actions\Index::class)
        ->name('index');

    Route::middleware('role:Educator|Admin')->group(function () {

        /*Volt::route('exam', 'exam')
            ->name('exam');*/
        Route::get('exam', \App\Livewire\Exams::class)
            ->name('exam');
        /*Volt::route('subject', 'subject')
            ->name('subject');*/
        Route::get('subject', \App\Livewire\Subjects::class)
            ->name('subject');
        /*Volt::route('quiz', 'quiz')
            ->name('quiz');*/
        Route::get('quiz', \App\Livewire\Quizzes::class)
            ->name('quiz');

    });

    Route::middleware('role:Analyser|Admin')->group(function () {
        Volt::route('report-exam', 'exam-report')
            ->name('report.exam');
        Volt::route('report-student', 'student-report')
            ->name('report.student');
        Route::get('grade', \App\Livewire\Grade::class)
            ->name('grade');
    });

    Route::get('grade/{id}', \App\Livewire\GradeDetail::class)
        ->name('grade.detail');

    Route::middleware('role:Educator|Analyser|Admin')->group(function () {

        Volt::route('homes', 'homes')
            ->name('homes');
        /*Volt::route('student', 'student')
            ->name('student');*/
        Route::get('student', \App\Livewire\Students::class)
            ->name('student');
    });

    Route::middleware('role:Student|Admin')->group(function () {
        Route::get('my-exam', \App\Livewire\MyExam::class)
            ->name('my-exam');

        Route::get('student-exam/{id}', \App\Livewire\StudentExam::class)
            ->name('student-exam');

        Route::get('recent-exam', \App\Livewire\RecentExam::class)
            ->name('recent-exam');
    });

    Route::get('session-exam', \App\Livewire\SessionExam::class)
        ->name('session.exam');
});

Route::get('/', fn() => view('livewire.auth.login'))->name('login');

require __DIR__.'/auth.php';

// require __DIR__ . '/dummy-fe.php';
