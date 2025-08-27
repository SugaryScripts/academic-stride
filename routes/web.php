<?php

use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;
use App\Livewire\Dashboard;

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

    Route::get('my-grades/{id}', \App\Livewire\GradeDetail::class)
        ->name('my-grades');

    Route::middleware('role:Educator|Analyser|Admin')->group(function () {

        Volt::route('homes', 'homes')
            ->name('homes');
        /*Volt::route('student', 'student')
            ->name('student');*/
        Route::get('student', \App\Livewire\Students::class)
            ->name('student');
    });

    Route::middleware('role:Student|Admin')->group(function () {
        Route::get('active-exam', \App\Livewire\ActiveExam::class)
            ->name('active-exam');

        Route::get('student-exam/{id}', \App\Livewire\StudentExam::class)
            ->name('student-exam');

        Route::get('past-exams', \App\Livewire\PastExam::class)
            ->name('past-exam');
        Route::get('available-exams', \App\Livewire\AvailableExams::class)
            ->name('available-exam');
    });

    Route::get('session-exam', \App\Livewire\SessionExam::class)
        ->name('session.exam');

    Route::get('payment', \App\Livewire\Payment::class)
        ->name('payment');
});




Route::get('/dashboard', Dashboard::class)->name('dashboard');


//Route::get('/', fn() => view('livewire.auth.login'))->name('login');

require __DIR__.'/auth.php';

//require __DIR__ . '/dummy-fe.php';
