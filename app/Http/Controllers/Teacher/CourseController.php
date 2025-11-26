<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CourseController extends Controller
{
    public function index(Request $request){
        $search_title = $request->search_title;
        $auth_user = Auth::user();
        $courses = Course::whereHas('topics', function($query) use ($auth_user){
                                $query->where('author_id', $auth_user->id);
                            })->when($search_title, function($query, $search_title){
                                $query->where('name', 'like', '%' . $search_title . '%');
                            })
                            ->where('status', 'Active')
                            ->latest()->paginate(10);
        
        return view('teacher.course.index', compact('courses', 'search_title'));                    
    }

    public function show(Course $course){
        $auth_user = Auth::user();
        $course = Course::whereHas('topics', function($query) use ($auth_user){
                                $query->where('author_id', $auth_user->id);
                            })->with(['topics' => function($query) use ($auth_user){
                                $query->where('author_id', $auth_user->id);
                            }])
                            ->where('status', 'Active')
                            ->where('id', $course->id)
                            ->firstOrFail();
                            
        return view('teacher.course.show', compact('course'));
    }


}
