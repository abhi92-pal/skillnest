<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CourseController extends Controller
{
    public function index(){
        return view('admin.course.index');
    }

    public function create(){
        return view('admin.course.create');
    }

    public function store(Request $request){
        $request->validate([
            'name' => 'required|max:200',
            'short_description' => 'required|max:200',
            'long_description' => 'required',
            'price' => 'required|numeric|gte:0',
            'selling_price' => 'required|numeric|gte:' . $request->price,
            'duration_type' => 'required|in:Year,Month,Day,Hour',
            'duration' => 'required|numeric|gt:0',
            'reg_end_date' => 'required|date|after:today',
            'topics' => 'required|array',
            'topics.*' => 'required'
        ]);

        DB::transaction(function() use ($request){
            Course::create([
                'name' => $request->name,
                'short_description' => $request->short_description,
                'long_description' => $request->long_description,
                'price' => $request->price,
                'selling_price' => $request->selling_price,
                'duration_type' => $request->duration_type,
                'duration' => $request->duration,
                'is_freezed' => 'No',
                'reg_end_date' => date('Y-m-d', strtotime($request->reg_end_date)),
            ]);
        });

        return response()->json(['message' => 'Course created successfully.']);
    }

    public function edit(Course $course){
        return view('admin.course.edit');
    }

    public function update(Request $request, Course $course){
        if($course->is_freezed == 'Yes'){
            return response()->json(['message' => 'You cannot edit this course as it is freezed.']);
        }

        $request->validate([
            'name' => 'required|max:200',
            'short_description' => 'required|max:200',
            'long_description' => 'required',
            'price' => 'required|numeric|gte:0',
            'selling_price' => 'required|numeric|gte:' . $request->price,
            'duration_type' => 'required|in:Year,Month,Day,Hour',
            'duration' => 'required|numeric|gt:0',
            'reg_end_date' => 'required|date|after:today'
        ]);

        DB::transaction(function() use ($request, $course){
            $course->update([
                'name' => $request->name,
                'short_description' => $request->short_description,
                'long_description' => $request->long_description,
                'price' => $request->price,
                'selling_price' => $request->selling_price,
                'duration_type' => $request->duration_type,
                'duration' => $request->duration,
                'reg_end_date' => date('Y-m-d', strtotime($request->reg_end_date)),
            ]);
        });

        return response()->json(['message' => 'Course created successfully.']);
    }
}
