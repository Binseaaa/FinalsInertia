<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\User;

class StudentController extends Controller
{
    public function index() {
        // Fetching students
        $students = Student::orderBy('id')->get();

        // Calculate total users
        $totalUsers = User::count();

        // Calculate students cleared
        $studentsCleared = Student::where('status', 'Cleared')->count();

        // Pass data to Inertia view
        return inertia('students/Index', [
            'students' => $students,
            'totalUsers' => $totalUsers,
            'studentsCleared' => $studentsCleared,
        ]);
    }

    public function dashboard() {
        $totalStudents = Student::count();
        $studentsCleared = Student::where('status', 'Cleared')->count();

        return inertia('Dashboard', [
            'totalStudents' => $totalStudents,
            'studentsCleared' => $studentsCleared
        ]);
    }
}
