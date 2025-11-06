<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Semester;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\CssSelector\Node\FunctionNode;

class CourseController extends Controller
{
    public function index(Request $request){
        $search_title = $request->search_title;
        $courses = Course::when($search_title, function($query, $search_title){
                                $query->where('name', 'like', '%' . $search_title . '%');
                            })->latest()->paginate(10);
                            
        return view('admin.course.index', compact('courses', 'search_title'));
    }

    public function create(){
        $teachers = User::where('role', 'Teacher')->where('status', 'Active')->get();
        $semesters = Semester::get();

        return view('admin.course.create', compact('teachers', 'semesters'));
    }

    public function store(Request $request){
        $rules = [
            'name' => 'required|max:200',
            'short_description' => 'required|max:200',
            'long_description' => 'required',
            'price' => 'required|numeric|gte:0',
            'selling_price' => 'required|numeric|gte:' . $request->price,
            'duration_type' => 'required|in:Year,Month,Day,Hour',
            'duration' => 'required|numeric|gt:0',
            'reg_end_date' => 'required|date|after:today',
            'no_of_semester' => 'required|numeric|gt:0|lte:16',
            't_name' => 'required|array',
            't_name.*' => 'required|string|max:100',
            't_description' => 'required|array',
            't_description.*' => 'required',
            't_author' => 'required|array',
            't_author.*' => [
                                'required',
                                function($attribute, $value, $fail){
                                    $exists = User::where('id', $value)->where('role', 'Teacher')->where('status', 'Active')->exists();
                                    if(!$exists){
                                        $fail('Author not found.');
                                    }
                                }
                            ],
            't_sem' => 'required|array',
            't_sem.*' => [
                            'required',
                            function($attribute, $value, $fail) use ($request){
                                $sem = Semester::find($value);
                                if(!$sem){
                                    $fail('Semester not found');
                                }else{
                                    if($sem->exam_sequence > $request->no_of_semester){
                                        $fail('Invalid semester, max semester is ' . $request->no_of_semester);
                                    }
                                }
                            }
                        ],
        ];

        $validator = Validator::make($request->all(), $rules, [], [
                                                                    't_name.*' => 'topic name',
                                                                    't_description.*' => 'description',
                                                                    't_author.*' => 'author',
                                                                    't_sem.*' => 'semester',
                                                                ]);

        if ($validator->fails()) {
            $validator_error_msg = $validator->getMessageBag()->toArray();
            $errors = [];
            foreach ($validator_error_msg as $attribute => $validator_error) {
                $attribute = str_replace('.', '_', $attribute);
                $errors[$attribute] = $validator_error;
            }
            
            return response()->json(['errors' => $errors, 'message' => 'Please fill with valid data.'], 422);
        }
        
        try{
            DB::transaction(function() use ($request){
                $course = Course::create([
                                'name' => $request->name,
                                'short_description' => $request->short_description,
                                'long_description' => $request->long_description,
                                'price' => $request->price,
                                'selling_price' => $request->selling_price,
                                'no_of_semesters' => $request->no_of_semester,
                                'duration_type' => $request->duration_type,
                                'duration' => $request->duration,
                                'is_freezed' => 'No',
                                'is_published' => 'No',
                                'status' => 'Inactive',
                                'reg_end_date' => date('Y-m-d', strtotime($request->reg_end_date)),
                            ]);
    
                foreach($request->t_name as $key => $t_name){
                    $topic = $course->topics()->create([
                        'name' => $request->t_name[$key],
                        'description' => $request->t_description[$key],
                        'created_by' => Auth::id(),
                        'author_id' => $request->t_author[$key],
                    ]);
    
                    $topic->semester_topics()->create([
                        'semester_id' => $request->t_sem[$key]
                    ]);
                }
    
            });
        }catch(\Exception $e){
            return response()->json(['message' => $e->getMessage()], 422);
        }

        return response()->json(['message' => 'Course created successfully.']);
    }

    public function edit(Course $course){
        $teachers = User::where('role', 'Teacher')->where('status', 'Active')->get();
        $semesters = Semester::get();

        return view('admin.course.edit', compact('teachers', 'semesters'));
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
            'reg_end_date' => 'required|date|after:today',
            'no_of_semester' => 'required|numeric|gt:0|lte:16',
            't_name' => 'required|array',
            't_name.*' => 'required|string|max:100',
            't_description' => 'required|array',
            't_description.*' => 'required',
            't_author' => 'required|array',
            't_author.*' => [
                                'required',
                                function($attribute, $value, $fail){
                                    $exists = User::where('id', $value)->where('role', 'Teacher')->where('status', 'Active')->exists();
                                    if(!$exists){
                                        $fail('Author not found.');
                                    }
                                }
                            ],
            't_sem' => 'required|array',
            't_sem.*' => [
                            'required',
                            function($attribute, $value, $fail) use ($request){
                                $sem = Semester::find($value);
                                if(!$sem){
                                    $fail('Semester not found');
                                }else{
                                    if($sem->exam_sequence > $request->no_of_semester){
                                        $fail('Invalid semester, max semester is ' . $request->no_of_semester);
                                    }
                                }
                            }
                        ],
        ]);

        try{
            DB::transaction(function() use ($request, $course){
                $course->update([
                                    'name' => $request->name,
                                    'short_description' => $request->short_description,
                                    'long_description' => $request->long_description,
                                    'price' => $request->price,
                                    'selling_price' => $request->selling_price,
                                    'no_of_semesters' => $request->no_of_semester,
                                    'duration_type' => $request->duration_type,
                                    'duration' => $request->duration,
                                    'reg_end_date' => date('Y-m-d', strtotime($request->reg_end_date)),
                                ]);
    
                $course->topics()->semester_topics()->delete();
                $course->topics()->delete();
    
                foreach($request->t_name as $key => $t_name){
                    $topic = $course->topics()->create([
                        'name' => $request->t_name[$key],
                        'description' => $request->t_description[$key],
                        'created_by' => Auth::id(),
                        'author_id' => $request->t_author[$key],
                    ]);
    
                    $topic->semester_topics()->create([
                        'semester_id' => $request->t_sem[$key]
                    ]);
                }
            });
        }catch(\Exception $e){
            return response()->json(['message' => $e->getMessage()], 422);
        }

        return response()->json(['message' => 'Course updated successfully.']);
    }

    public function freezeCourse(Course $course){
        if($course->is_freezed == 'Yes'){
            return response()->json(['message' => 'Course is already freezed.'], 422);
        }

        $course->update(['is_freezed' => 'Yes']);

        return response()->json(['message' => 'Course is freezed. Now course can be made active and publish.']);
    }

    public function changeStatus(Course $course){
        if($course->is_freezed == 'Yes'){
            $message = 'Course status has been changed successfully.';
            if($course->status == 'Inactive'){
                $message .= ' Now course will be visible to the teacher portal.';
            }else{
                $message .= ' Now course will not be visible to the teacher portal.';
            }

            $course->update([
                                'status' => $course->status == 'Active' ? 'Inactive' : 'Active'
                            ]);

            return response()->json(['message' => $message]);
        }else{
            return response()->json(['message' => 'Course status cannot be changed as it is not freezed yet.'], 422);
        }

    }

    public function publishCourse(Course $course){
        if($course->is_freezed == 'Yes'){
            if($course->is_published == 'Yes'){
                return response()->json(['message' => 'Course is already published.'], 422);
            }

            $course->update([
                                'is_published' => 'Yes'
                            ]);

            return response()->json(['message' => 'Course is published. Now course will be visible in the frontend.']);
        }else{
            return response()->json(['message' => 'Course cannot be made publish as it is not freezed yet.'], 422);
        }

    }
}
