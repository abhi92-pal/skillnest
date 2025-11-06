<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Lession;
use App\Models\Topic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class LessionController extends Controller
{
    public function index(Topic $topic){
        $auth_user = Auth::user();
        if($topic->author_id != $auth_user->id || !$topic->course || $topic->course->status == 'Inactive'){
            abort(404);
        }

        $lessions = Lession::where('topic_id', $topic->id)->latest()->paginate(10);

        return view('teacher.lession.index', compact('lessions', 'topic'));
    }

    public function store(Topic $topic, Request $request){
        $request->validate([
            'name' => 'required|max:200',
            'description' => 'required',
            'type' => 'required|in:Video,Text,Quiz',
            'content_url' => 'required|nullable|url',
            'duration' => 'required|numeric|gt:0',
        ]);

        try{
            DB::transaction(function() use ($request, $topic) {
                $topic->lessions()->create([
                    'type' => $request->type,
                    'name' => $request->name,
                    'description' => $request->description,
                    'content_url' => $request->content_url,
                    'duration' => $request->duration,
                    'language' => 'EN',
                    'created_by' => Auth::id(),
                ]);

            });

            return response()->json(['message' => 'Lession created successfully']);
        }catch(\Exception $e){
            return response()->json(['message' => $e->getMessage()], 422);
        }
    }
}
