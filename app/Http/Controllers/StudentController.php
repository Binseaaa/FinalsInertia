<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\User;
use Inertia\Inertia;

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

    public function create() {
        return Inertia::render('students/Create');
    }

    public function show(Student $student) {
        return Inertia::render('students/Show', [
            'students' => $student
        ]);
    }

    public function update(Request $request,Student $student) {
        $student->update($request->validate([
            'name'      => 'required',
            'email'     => 'required',
            'department'=> 'required',
            'status'    => 'required'
        ]));

        return back();
    }

    public function store(Request $request) {
        Student::create($request->validate([
            'name'      => 'required',
            'email'     => 'required',
            'department'=> 'required',
            'status'    => 'required'
        ]));
        return redirect('/student');
    }

    public function destroy(Student $student) {
        $student->delete();

        return redirect('/student');
    }
}
