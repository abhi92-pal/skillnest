<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Coursecategory;
use App\Models\Semester;
use App\Models\Topic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CourseController extends Controller
{
    /**
     * This list will be used for Dropdown
     */
    public function getCategoryWiseSimpleList(){
        $categories = Coursecategory::whereHas('courses', function($query){
                                        $query->where('is_published', 'Yes')->where('status', 'Active');
                                    })->where('status', 'Active')->get(['id', 'name']);

        if($categories->count()){
            foreach($categories as $category){
                $courses = Course::whereHas('coursecategories', function($query) use ($category){
                                        $query->where('id', $category->id);
                                    })
                                    ->where('is_published', 'Yes')->where('status', 'Active')
                                    ->get(['id', 'name']);
                $category->courses = $courses;
            }
        }

        return $this->sendSuccess('Course list fetched successfully', ['category_wise_courses' => $categories]);
    }
    
    // Course list api
    public function index(Request $request){
        // $courses = Course::where('is_published', 'Yes')->where('status', 'Active')
        //                             ->paginate(10);
        $courses = Course::with('coursecategories')->when($request->coursecategory_id, function ($query) use ($request) {
            $query->whereHas('coursecategories', function ($q) use ($request) {
                $q->where('coursecategory_id', $request->coursecategory_id);
            });
        })->paginate(10);


        $courses->getCollection()->transform(function ($course) {
            $course->file_path = asset('storage/' . $course->file_path);
            return $course;
        });

        return $this->sendSuccess('Course list fetched successfully', ['courses' => $courses]);
    }
    
    public function show(Course $course){
        $course->load(['coursecategories']);
        $course->file_path = asset('storage/' . $course->file_path);
        $semesters = Semester::where('exam_sequence', '<=', $course->no_of_semesters)->get();

        foreach($semesters as $semester){
            $topics = Topic::where('course_id', $course->id)
                            ->whereHas('semester_topics', function($query) use ($semester){
                                $query->where('semester_id', $semester->id);
                            })->get();

            $semester->sem_topics = $topics;

        }
        
        $course->coursecategories = $course->coursecategories->map(function($category){
            $category->file = asset('storage/' . $category->file);
            return $category;
        });


        return $this->sendSuccess('Course list fetched successfully', ['course' => $course, 'semesters' => $semesters]);
    }

    public function myCourses(Request $request){
        
        $courses = Course::with('coursecategories')->when($request->coursecategory_id, function ($query) use ($request) {
            $query->whereHas('coursecategories', function ($q) use ($request) {
                $q->where('coursecategory_id', $request->coursecategory_id);
            });
        })->paginate(10);


        $courses->getCollection()->transform(function ($course) {
            $course->file_path = asset('storage/' . $course->file_path);
            return $course;
        });

        return $this->sendSuccess('Course list fetched successfully', ['courses' => $courses]);
    }

    public function myCourseDetails(Course $course){
        $auth_student = Auth::user()->student;
        $course->load(['coursecategories']);
        $course->file_path = asset('storage/' . $course->file_path);
        $semesters = Semester::where('exam_sequence', '<=', $course->no_of_semesters)->get();

        foreach($semesters as $semester){
            $topics = Topic::with(['lessions'])->where('course_id', $course->id)
                            ->whereHas('semester_topics', function($query) use ($semester){
                                $query->where('semester_id', $semester->id);
                            })->get();

            $topics = $topics->map(function($topic) use ($auth_student){
                $topic->lessions = $topic->lessions->map(function($lesson) use ($auth_student){
                    // $lesson->content_url = asset('storage/images/lessions/' . $lesson->content_url);
                    $studentlesson = $lesson->studentlessons()->where('student_id', $auth_student->id)->first();
                    $lesson->progress_status = $studentlesson ? $studentlesson->status : 'Not Started';
                    unset($lesson->content_url);
                    return $lesson;
                });
                return $topic;
            });

            $semester->sem_topics = $topics;

        }
        
        $course->coursecategories = $course->coursecategories->map(function($category){
            $category->file = asset('storage/' . $category->file);
            return $category;
        });


        return $this->sendSuccess('Course list fetched successfully', ['course' => $course, 'semesters' => $semesters]);
    }
}
