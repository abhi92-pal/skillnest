<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Course;
use App\Models\Lession;
use App\Models\Coursecategory;
use App\Models\Semester;
use App\Models\SemesterTopic;
use App\Models\Topic;
use App\Models\User;
use App\Models\Order;
use App\Models\StudentLession;
use App\Models\Teacher;
use App\Models\Student;

class DashboardController extends Controller
{
    public function index(){

    $teacher_count = Teacher::count();
    $student_count = Student::count();
    $course_count = Course::count();

        return view('admin.dashboard',compact('teacher_count', 'student_count', 'course_count'));
    }
}
