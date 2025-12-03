<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Coursecategory;
use Illuminate\Http\Request;

class CourseCategoryController extends Controller
{
    public function index(){
        // $categories = Coursecategory::whereHas('courses', function($query){
        //                                 $query->where('is_published', 'Yes')->where('status', 'Active');
        //                             })->where('status', 'Active')->get();
        $categories = Coursecategory::where('status', 'Active')->get();

        if($categories->count()){
            foreach($categories as $category){
                $category->file = $category->file ? asset('storage/' . $category->file) : '';
            }
        }

        return $this->sendSuccess('Category list fetched successfully', ['categories' => $categories]);
    }
}
