<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Coursecategory;
use Illuminate\Http\Request;

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
}
