<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Topic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TopicController extends Controller
{
    public function index(Request $request, Course $course){
        $search_title = $request->search_title;
        $auth_user = Auth::user();
            $topics = Topic::where('course_id', $course->id)->where('author_id', $auth_user->id)
                            ->when($search_title, function($query, $search_title){
                                $query->where('name', 'like', '%' . $search_title . '%');
                            })->latest()->paginate(5);
                            
        
        return view('teacher.topic.index', compact('topics', 'search_title'));                    
    }


}
