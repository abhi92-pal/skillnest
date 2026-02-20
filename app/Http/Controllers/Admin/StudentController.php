<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Student;

class StudentController extends Controller
{
    public function index(){
        $students = Student::get();
        return view('admin.student.index', compact('students'));
    }

    public function create(){
        return view('admin.student.create');
    }
}
