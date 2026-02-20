<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Cache;
use Symfony\Component\HttpFoundation\StreamedResponse;

use App\Models\Course;
use App\Models\Coursecategory;
use App\Models\Exampaper;
use App\Models\Lession;
use App\Models\Topic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ExampaperController extends Controller
{
    public function getQuestions(Exampaper $exampaper){
        $exampaper->load([
                            'questiontypes',
                            'questions.questionoptions'
                        ]);

        $response = [
            'exampaper_id' => $exampaper->id,
            'exampaper_name' => $exampaper->name,
            'duration' => $exampaper->duration,
            'total_marks' => $exampaper->total_marks,
            'sections' => []
        ];

        $questiontypes = $exampaper->questiontypes->sortBy('sortid')->values();

        foreach ($questiontypes as $questionType) {
            $sectionQuestions = $exampaper->questions
                ->where('questiontype_id', $questionType->id)
                ->values();

            $eachMark = $questionType->pivot->total_marks / $questionType->pivot->evaluated_question_nos;

            $questionsData = [];

            foreach ($sectionQuestions as $question) {

                $optionsData = [];
                if($questionType->will_have_ans_choice == 'Yes'){
                    foreach ($question->questionoptions as $option) {
                        $optionsData[] = [
                            'option_id' => $option->id,
                            'option_text' => $option->option,
                        ];
                    }
                }

                $questionsData[] = [
                    'question_id' => $question->id,
                    'question' => $question->question,
                    'marks' => $eachMark,
                    'options' => $optionsData
                ];
            }

            $response['sections'][] = [
                'question_type_id' => $questionType->id,
                'question_type_name' => $questionType->name,
                'description' => $questionType->pivot->description,
                'total_marks' => $questionType->pivot->total_marks,
                'total_questions' => $questionType->pivot->total_questions,
                'will_have_ans_choice' => $questionType->will_have_ans_choice,
                'evaluated_question_number' => $questionType->pivot->evaluated_question_nos,
                'questions' => $questionsData
            ];
        }

        return response()->json(['data' => $response, 'message' => 'Question fetched successfully.']);
    }
}
