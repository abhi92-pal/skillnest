<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Order;
use App\Models\Semester;
use Illuminate\Http\Request;

use App\Models\Student;
use App\Models\Topic;

class StudentController extends Controller
{
    public function index(){
        $students = Student::get();
        return view('admin.student.index', compact('students'));
    }

    public function create(){
        return view('admin.student.create');
    }

    public function studentCourses(Student $student){
        $user = $student->user;
        $courseIds = Order::where('user_id', $user->id)->where('status', 'Approved')->pluck('course_id')->toArray();
        $courses = Course::with([
                                    'orders' => fn($q) => $q->where('user_id', $user->id)
                                ])
                            ->whereIn('id', $courseIds)->latest()->get();
        
        return view('admin.student.courses', compact('courses', 'student'));
    }

    public function studentCourseDetails($student, $course){
        $student = Student::find($student);
        $course = Course::find($course);
        $semesters = Semester::where('exam_sequence', '<=', $course->no_of_semesters)->get();

        foreach($semesters as $semester){
            $topics = Topic::with('lessions')
                            ->where('course_id', $course->id)
                            ->whereHas('semester_topics', function($query) use ($semester){
                                $query->where('semester_id', $semester->id);
                            })->get();

            $semester->sem_topics = $topics;

        }
        
        return view('admin.student.course_details', compact('student', 'course', 'semesters'));
    }
}
