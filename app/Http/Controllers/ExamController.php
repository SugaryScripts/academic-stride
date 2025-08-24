<?php

namespace App\Http\Controllers;
use App\Models\Assessment\Exam;
use Inertia\Inertia;

use Illuminate\Http\Request;

class ExamController extends Controller
{
    public function index()
        {
          $exams = Exam::all();

        // Kirim data 'exams' ke komponen frontend melalui Inertia
        return Inertia::render('MyExam', [
            'exams' => $exams,
        ]);
        }
}
