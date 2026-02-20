<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Lession;
use App\Models\Topic;

class DashboardController extends Controller
{
    public function index(){
        return view('teacher.dashboard');
    }
}
