<?php

namespace App\Http\Controllers\Admin;

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

        $lessions = Lession::where('topic_id', $topic->id)->latest()->paginate(10);

        return view('admin.lession.index', compact('lessions', 'topic'));
    }

    public function getContent(Lession $lession){
        return view('admin.lession.preview', compact('lession'));
    }
}
