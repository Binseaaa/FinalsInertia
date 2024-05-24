<?php

namespace App\Http\Controllers;

use App\Models\Student;

class StudentController extends Controller
{
    public function index() {
        $students = Student::orderBy('id')->get();

        return inertia('Student', [
            'students' => $students
        ]);
    }
}
