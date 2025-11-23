<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Examslot;

class ExamslotController extends Controller
{
    public function index(Request $request){
        $examslots = Examslot::where('semester_id', $request->semester)->where('topic_id', $request->topic)->get();
        $html = view('admin.course.partials.exam-slot', compact('examslots'))->render();

        return response()->json(['data' => ['html' => $html], 'message' => 'Data fetched successfully']);
    }

    public function createOrUpdate(Request $request){
        $starts_at = str_replace('/', '-', $request->exam_slot);
        $request->merge([
            'exam_slot' => $starts_at
        ]);

        $request->validate([
            'semester' => ['required'],
            'topic' => ['required'],
            'exam_slot' => ['required', 'date', 'after:today'],
            'max_candidate' => ['required', 'numeric', 'gt:0'],
        ]);


        if(!empty($request->slot_id)){
            $examslot = Examslot::find($request->slot_id);
            if(!$examslot){
                return response()->json(['message' => 'No examslot found'], 422);
            }
            if($examslot->rem_seat != $examslot->max_candidate){
                return response()->json(['message' => 'You cannnot edit this slot'], 422);
            }

        }else{
            $examslot = new Examslot();
            $examslot->semester_id = $request->semester;
            $examslot->topic_id = $request->topic;
        }

        $examslot->starts_at = date('Y-m-d H:i:s', strtotime($request->exam_slot));
        $examslot->max_candidate = $request->max_candidate;
        $examslot->rem_seat = $request->max_candidate;
        $examslot->save();

        return response()->json(['message' => 'Exam slot saved successfully.']);

    }

    public function destroy(Examslot $examslot){
        if($examslot->exampaper()->count() > 0){
            return response()->json(['message' => 'You cannot delete this slot'], 422);
        }

        $examslot->delete();

        return response()->json(['message' => 'Slot has been deleted successfully']);
    }
}
