<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Exampaper;
use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ExampaperController extends Controller
{
    public function index(Request $request)
    {
        $auth_user = Auth::user();
        $exampapers = Exampaper::whereHas('topic', function ($query) use ($auth_user) {
            $query->where('author_id', $auth_user->id);
        })
            ->where('is_freezed', 'Yes')
            ->latest()->paginate(10);

        return view('teacher.exampaper-structure.index', compact('exampapers'));
    }

    public function show($exampaper)
    {
        $auth_user = Auth::user();
        $exampaper = Exampaper::whereHas('topic', function ($query) use ($auth_user) {
            $query->where('author_id', $auth_user->id);
        })
            ->with('questiontypes')
            ->where('is_freezed', 'Yes')
            ->where('id', $exampaper)
            ->firstOrFail();

        $questiontypes = $exampaper->questiontypes;

        return view('teacher.exampaper-structure.show', compact('exampaper', 'questiontypes'));
    }

    public function store(Request $request, Exampaper $exampaper)
    {
        $rules = [
            'questions' => 'required|array',
            'questions.*' => 'required|array',
            'questions.*.*.question' => 'required|string',
            'questions.*.*.options' => 'nullable|array',
            'questions.*.*.options.*' => 'nullable|string',
            'questions.*.*.correct_option' => 'nullable|numeric',
        ];

        $validator = Validator::make($request->all(), $rules, [], [
            'questions.*.*.question' => 'question',
            'questions.*.*.options.*' => 'option',
            'questions.*.*.correct_option' => 'correct option',
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

            DB::transaction(function () use ($request, $exampaper) {
                foreach ($request->questions as $questionTypeId => $questions) {
                    $pivot = $exampaper->questiontypes()
                        ->where('questiontype_id', $questionTypeId)
                        ->first()
                        ->pivot;

                    $eachQuestionMark = $pivot->total_marks / $pivot->evaluated_question_nos;

                    foreach ($questions as $qNo => $questionData) {

                        $question = Question::create([
                            'exampaper_id' => $exampaper->id,
                            'questiontype_id' => $questionTypeId,
                            'question' => $questionData['question'],
                            'marks' => $eachQuestionMark,
                            // 'created_by' => Auth::id(),
                        ]);

                        if (!empty($questionData['options'])) {

                            foreach ($questionData['options'] as $optIndex => $optionText) {

                                $question->questionoptions()->create([
                                    'option' => $optionText,
                                    'is_correct' => (isset($questionData['correct_option']) &&
                                        $questionData['correct_option'] == $optIndex)
                                        ? 'Yes'
                                        : 'No'
                                ]);
                            }
                        }
                    }
                }
            });
        } catch (\Exception $e) {

            return response()->json([
                'message' => $e->getMessage()
            ], 422);
        }

        return response()->json([
            'message' => 'Questions saved successfully.',
            'redirect_url' => route('teacher.exampaper-structure.index')
        ]);
    }

    public function update(Request $request, Exampaper $exampaper)
    {
        if($exampaper->is_question_freezed == 'Yes'){
            return response()->json([
                'message' => 'You cannot update as the questions are already freezed.'
            ], 422);
        }
        
        $rules = [
            'questions' => 'required|array',
            'questions.*' => 'required|array',
            'questions.*.*.question' => 'required|string',
            'questions.*.*.options' => 'nullable|array',
            'questions.*.*.options.*' => 'nullable|string',
            'questions.*.*.correct_option' => 'nullable|numeric',
        ];

        $validator = Validator::make($request->all(), $rules, [], [
            'questions.*.*.question' => 'question',
            'questions.*.*.options.*' => 'option',
            'questions.*.*.correct_option' => 'correct option',
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

            DB::transaction(function () use ($request, $examId) {

                $exam = Exampaper::with('questiontypes')->findOrFail($examId);

                Question::where('exam_id', $exam->id)->delete();

                foreach ($request->questions as $questionTypeId => $questions) {

                    $pivotRelation = $exam->questiontypes()
                        ->where('question_type_id', $questionTypeId)
                        ->first();

                    if (!$pivotRelation) {
                        throw new \Exception('Invalid question type for this exam.');
                    }

                    $pivot = $pivotRelation->pivot;

                    // Validate question count matches pivot rule
                    if (count($questions) != $pivot->total_questions) {
                        throw new \Exception('Invalid number of questions for section.');
                    }

                    $eachMark = $pivot->total_marks / $pivot->evaluated_question_number;

                    foreach ($questions as $qNo => $questionData) {

                        $question = Question::create([
                            'exam_id' => $exam->id,
                            'question_type_id' => $questionTypeId,
                            'question' => $questionData['question'],
                            'marks' => $eachMark,
                            'created_by' => Auth::id(),
                        ]);

                        // If section allows options
                        if (!empty($questionData['options'])) {

                            if (!isset($questionData['correct_option'])) {
                                throw new \Exception('Correct option must be selected.');
                            }

                            foreach ($questionData['options'] as $optIndex => $optionText) {

                                $question->options()->create([
                                    'option_text' => $optionText,
                                    'is_correct' => ($questionData['correct_option'] == $optIndex)
                                        ? 'Yes'
                                        : 'No'
                                ]);
                            }
                        }
                    }
                }
            });
        } catch (\Exception $e) {

            return response()->json([
                'message' => $e->getMessage()
            ], 422);
        }

        return response()->json([
            'message' => 'Questions updated successfully.',
            'redirect_url' => route('admin.exam.index')
        ]);
    }

    
    public function freezeQuestion(Exampaper $exampaper){
        if(!$exampaper->questions()->count()){
            return response()->json(['message' => 'Please set questions in order to freeze.'], 422);
        }
            
        if($exampaper->is_question_freezed == 'Yes'){
            return response()->json(['message' => 'Questions is already freezed.'], 422);
        }

        $exampaper->update(['is_question_freezed' => 'Yes']);

        return response()->json(['message' => 'Questions is freezed.']);
    }
}
