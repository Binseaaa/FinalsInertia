<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\User;
use Inertia\Inertia;

class StudentController extends Controller
{
    public function index() {
        $students = Student::orderBy('id')->get();
        $totalUsers = User::count();
        $studentsCleared = Student::where('status', 'Cleared')->count();

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
        session()->flash('flash', ['type' => 'success', 'message' => 'Student created successfully!']);
        return Inertia::render('students/Index', [
            'flash' => [
                'type' => session('success'),
                'message' => session('message'),
            ]
        ]);
    }

    public function show(Student $student) {
        return Inertia::render('students/Show', [
            'students' => $student
        ]);
    }

    public function update(Request $request, Student $student) {
        $student->update($request->validate([
            'name' => 'required',
            'email' => 'required',
            'department' => 'required',
            'status' => 'required'
        ]));

        session()->flash('flash', ['type' => 'success', 'message' => 'Student updated successfully!']);
        return back();
    }

    public function store(Request $request) {
        Student::create($request->validate([
            'name' => 'required',
            'email' => 'required',
            'department' => 'required',
            'status' => 'required'
        ]));

        session()->flash('flash', ['type' => 'success', 'message' => 'Student created successfully!']);
        return redirect('/student');
    }

    public function destroy(Student $student) {
        $student->delete();

        session()->flash('flash', ['type' => 'success', 'message' => 'Student deleted successfully!']);
        return redirect('/student');
    }
}
