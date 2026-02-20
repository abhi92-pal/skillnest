<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Exampaper;
use Illuminate\Http\Request;

use App\Models\Lession;
use App\Models\Topic;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index(){
        $auth_user = Auth::user();
        $pending_exampaper_count = Exampaper::whereHas('topic', function ($query) use ($auth_user) {
                                                $query->where('author_id', $auth_user->id);
                                            })->doesntHave('questions')->count();

        $pending_upload_lession_count = Topic::where('author_id', $auth_user->id)
                            ->doesntHave('lessions')->count();

        return view('teacher.dashboard', compact('pending_exampaper_count','pending_upload_lession_count'));
    }
}
