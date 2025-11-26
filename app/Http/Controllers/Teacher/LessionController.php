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
        // $request->validate([
        //     'name' => 'required|max:200',
        //     'description' => 'required',
        //     'type' => 'required|in:Video,Text,Quiz',
        //     'content_url' => 'required|nullable|url',
        //     'duration' => 'required|numeric|gt:0',
        // ]);

        $rules = [
            'name' => 'required|max:200',
            'description' => 'required',
            'type' => 'required|in:Video,Text,Quiz',
            'duration' => 'required|numeric|gt:0',
        ];

        if ($request->type === 'Video') {
            $rules['content'] = 'required|file|mimes:mp4,m4v|max:200000';
        }

        if ($request->type === 'Text') {
            $rules['content'] = 'required|file|mimes:pdf|max:20000';
        }

        if ($request->type === 'Quiz') {
            $rules['content'] = 'nullable';
        }

        $request->validate($rules);

        try{
            $path = null;
            $filename = null;
            if ($request->hasFile('content')) {
                $filename = time() . '.' . $request->content->extension();
                $path = $request->content->storeAs('images/lessions', $filename, 'public');
            }

            DB::transaction(function() use ($request, $topic, $filename) {
                $topic->lessions()->create([
                    'type' => $request->type,
                    'name' => $request->name,
                    'description' => $request->description,
                    'content_url' => $filename,
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

    public function freezeCourse(Lession $lession){
        if($lession->is_freezed == 'Yes'){
            return response()->json(['message' => 'Lession is already freezed.'], 422);
        }

        $lession->update(['is_freezed' => 'Yes']);

        return response()->json(['message' => 'Lession is freezed.']);
    }

    public function destroy(Lession $lession){
        if($lession->is_freezed == 'Yes'){
            return response()->json(['message' => "You can’t delete it because it is already frozen."], 422);
        }

        $lession->delete();

        return response()->json(['message' => 'Lession is deleted successfully.']);
    }
}
