<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Exampaper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ExampaperController extends Controller
{
    public function index(Request $request){
        $auth_user = Auth::user();
        $exampapers = Exampaper::whereHas('topic', function($query) use ($auth_user){
                                $query->where('author_id', $auth_user->id);
                            })
                            ->where('is_freezed', 'Yes')
                            ->latest()->paginate(10);
        
        return view('teacher.exampaper-structure.index', compact('exampapers'));                    
    }

    public function show($exampaper){
        $auth_user = Auth::user();
        $exampaper = Exampaper::whereHas('topic', function($query) use ($auth_user){
                                $query->where('author_id', $auth_user->id);
                            })
                            ->with('questiontypes')
                            ->where('is_freezed', 'Yes')
                            ->where('id', $exampaper)
                            ->firstOrFail();

        $questiontypes = $exampaper->questiontypes;
        
        return view('teacher.exampaper-structure.show', compact('exampaper', 'questiontypes'));
    }


}
