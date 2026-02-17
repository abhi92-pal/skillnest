<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Lession;
use App\Models\StudentLession;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class LessonController extends Controller
{
    public function recordProgress(Request $request, Lession $lession){
        // $auth_user_id = Auth::id();
        $auth_student = Auth::user()->student;
        $auth_student_id = $auth_student->id;
        $request->validate([
            'progress' => 'required|numeric|gte:0'
        ]);

        $progress = 0;
        if($lession->type == 'Text'){
            $progress = $request->progress;
        }elseif($lession->type == 'Video'){
            $total_duration = $lession->duration; // In seconds
            $progress = round(($request->progress / $total_duration) * 100); 
            if($progress > 100){
                $progress = 100;
            }

        }else{
            return $this->sendError('Invalid lesson type.');
        }

        $progress_status = NULL;
        try{
            DB::transaction(function() use ($request, $lession, $auth_student_id, $progress, &$progress_status){
                $studentLesson = StudentLession::where('lession_id', $lession->id)->where('student_id', $auth_student_id)->first();
                if($studentLesson){
                    if($studentLesson->progress <= $progress){
                        $studentLesson->update([
                            'progress' => $progress,
                            'status' => $progress < 100 ? 'In Progress' : 'Completed',
                        ]);
                    }
                }else{
                    $studentLesson = StudentLession::create([
                                                                'lession_id' => $lession->id,
                                                                'student_id' => $auth_student_id,
                                                                'status' => 'In Progress',
                                                                'progress' => $progress,
                                                            ]);
                }

                $progress_status = $studentLesson->status;
            });
        }catch(\Exception $e){
            return $this->sendError($e->getMessage());
        }

        return $this->sendSuccess('Progress recorded successfully.', ['progress_status' => $progress_status]);
    }
}
