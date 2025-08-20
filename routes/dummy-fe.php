<?php

use Inertia\Inertia;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return Inertia::render('home');
});

Route::get('/login', function () {
    return Inertia::render('login');
});

Route::get('/my-exam', function () {
    return Inertia::render('students/myExam');
});
Route::get('/recent-exam', function () {
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


