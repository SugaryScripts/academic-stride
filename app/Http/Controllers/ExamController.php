<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ExamController extends Controller
{
    public function myExam()
    {
        // Get exams for the authenticated student
        $user = auth()->user();
        $student = $user->student;

        // You can load exams data here
        $exams = collect(); // Replace with actual exam data

        return Inertia::render('students/myExam', [
            'exams' => $exams,
            'user' => $user
        ]);
    }
}
