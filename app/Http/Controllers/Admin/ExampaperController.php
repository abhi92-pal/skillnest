<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Exampaper;
use Illuminate\Http\Request;

use App\Models\Examslot;
use App\Models\Questiontype;
use App\Models\Semester;
use App\Models\Topic;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ExampaperController extends Controller
{
    public function index(Request $request){
        $exampapers = Exampaper::latest()->paginate(10);

        return view('admin.exampaper-structure.index', compact('exampapers'));
    }

    public function create(Request $request){
        $courses = Course::where('is_freezed', 'Yes')->where('is_published', 'Yes')->where('status', 'Active')->get();
        $questiontypes = Questiontype::get();

        return view('admin.exampaper-structure.create', compact('courses', 'questiontypes'));
    }

    public function store(Request $request)
    {
        $rules = [
            'name' => 'required|max:200',
            'course' => 'required|exists:courses,id',
            'semester' => 'required|exists:semesters,id',
            'topic' => 'required|exists:topics,id',
            'exam_slot' => 'required|exists:examslots,id',

            'duration' => 'required|numeric|gt:0',
            'grace_period' => 'required|numeric|gte:0',
            'paper_total_marks' => 'required|numeric|gt:0',
            'is_gradable' => 'required|in:Yes,No',

            'question_type' => 'required|array',
            'question_type.*' => 'required|exists:questiontypes,id',

            'total_marks.*' => 'required|numeric|gt:0',
            'total_question.*' => 'required|numeric|gt:0',
            'evaluated_question_number.*' => 'required|numeric|gt:0',
            'short_description.*' => 'required|max:500',
        ];

        $validator = Validator::make($request->all(), $rules, [], [
            'paper_total_marks' => 'total marks',
            'question_type.*' => 'question type',
            'total_marks.*' => 'section total marks',
            'total_question.*' => 'total question',
            'evaluated_question_number.*' => 'evaluated question number',
            'short_description.*' => 'short description',
        ]);

        if ($validator->fails()) {

            $validator_error_msg = $validator->getMessageBag()->toArray();
            $errors = [];

            foreach ($validator_error_msg as $attribute => $validator_error) {
                $attribute = str_replace('.', '_', $attribute);
                $errors[$attribute] = $validator_error;
            }

            return response()->json([
                'errors' => $errors,
                'message' => 'Please fill with valid data.'
            ], 422);
        }

        try {
            $check = Exampaper::where([
                                        'course_id' => $request->course,
                                        'semester_id' => $request->semester,
                                        'topic_id' => $request->topic,
                                        'examslot_id' => $request->exam_slot,
                                    ])->exists();
            if($check){
                throw new \Exception('The exampaper structure has already been created');
            }
            
            DB::transaction(function () use ($request) {
                $exampaper = Exampaper::create([
                    'name' => $request->name,
                    'course_id' => $request->course,
                    'semester_id' => $request->semester,
                    'topic_id' => $request->topic,
                    'examslot_id' => $request->exam_slot,
                    'duration' => $request->duration,
                    'grace_period' => $request->grace_period,
                    'total_marks' => $request->paper_total_marks,
                    'is_gradable' => $request->is_gradable,
                    'is_freezed' => 'No',
                ]);

                $section_total_marks = 0;
                foreach ($request->question_type as $questionTypeId) {
                    $section_total_marks += $request->total_marks[$questionTypeId];
                    $exampaper->questiontypes()->attach($questionTypeId, [
                        'questiontype_id' => $questionTypeId,
                        'total_marks' => $request->total_marks[$questionTypeId],
                        'total_questions' => $request->total_question[$questionTypeId],
                        'evaluated_question_nos' => $request->evaluated_question_number[$questionTypeId],
                        'description' => $request->short_description[$questionTypeId],
                    ]);
                }

                if($section_total_marks != $request->paper_total_marks){
                    throw new \Exception('Question type wise total marks and paper total marks are not matching.');
                }

            });

        } catch (\Exception $e) {

            return response()->json([
                'message' => $e->getMessage()
            ], 422);
        }

        return response()->json([
            'message' => 'Exam paper structure created successfully.',
            'redirect_url' => route('admin.exampaper-structure.index')
        ]);
    }

    public function freezeExampaper(Exampaper $exampaper){
        if($exampaper->is_freezed == 'Yes'){
            return response()->json(['message' => 'Exampaper structure is already freezed.'], 422);
        }

        $exampaper->update(['is_freezed' => 'Yes']);

        return response()->json(['message' => 'Exampaper structure is freezed.']);
    }


    // public function destroy(Examslot $examslot){
    //     if($examslot->exampaper()->count() > 0){
    //         return response()->json(['message' => 'You cannot delete this slot'], 422);
    //     }

    //     $examslot->delete();

    //     return response()->json(['message' => 'Slot has been deleted successfully']);
    // }

    public function getSemesters(Request $request){
        $course = Course::where('is_freezed', 'Yes')->where('is_published', 'Yes')->where('status', 'Active')->where('id', $request->course)->first();
        if(!$course){
            return response()->json(['message' => 'Course not found'], 422);
        }
        $semesters = Semester::orderBy('exam_sequence', 'ASC')->take($course->no_of_semesters)->get();

        return response()->json(['semesters' => $semesters, 'message' => 'Data fetched successfully']);
    }

    public function getTopics(Request $request){
        $topics = Topic::where('course_id', $request->course)
                        ->whereHas('semester_topics', function($query) use ($request){
                            $query->where('semester_id', $request->semester);
                        })->get();

        return response()->json(['topics' => $topics, 'message' => 'Data fetched successfully']);
    }

    public function getExamSlots(Request $request){
        $examslots = Examslot::where('topic_id', $request->topic)->where('semester_id', $request->semester)->get();
        $examslots = $examslots->map(function($examslot){
            $examslot->formatted_starts_at = date('d/m/Y h:i A', strtotime($examslot->starts_at));

            return $examslot;
        });

        return response()->json(['examslots' => $examslots, 'message' => 'Data fetched successfully']);
    }
}
