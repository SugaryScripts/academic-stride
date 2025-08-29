<?php

use Inertia\Inertia;
use Illuminate\Support\Facades\Route;
use App\Models\Assessment\Exam;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Student\ExamController;

Route::get('/', function () {
    return Inertia::render('home');
});

Route::get('/login', [LoginController::class, 'show'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::middleware(['auth', 'role:student'])->group(function () {
    Route::get('/students/my-exam', [ExamController::class, 'myExam'])->name('students.my-exam');
    // Add other student routes here
});



Route::get('/active-exam', function () {
    // Eager load 'sessionExams' dengan 'exam' yang mencakup kolom title dari exam dan user_id dari sessionExams
    $exams = Exam::with(['sessionExams' => function ($query) {
        $query->select('id', 'exam_id', 'user_id');
    }, 'sessionExams.exam' => function ($query) {
        $query->select('id', 'title'); // Menambahkan title dari exam
    }])->get();

    return Inertia::render('students/myExam', [
        'exams' => $exams,
    ]);
})->name('active-exam');

Route::get('/past-exam', function () {
    return Inertia::render('students/recentExam');
});
Route::get('/grade-exam', function () {
    return Inertia::render('students/gradeExam');
});

Route::get('/student-exam', function () {
    return Inertia::render('students/studentExam');
});

Route::get('/admin', function(){
    return Inertia::render('admin/about');
});

Route::get('/mtk', function(){
    return Inertia::render('mtk');
});


