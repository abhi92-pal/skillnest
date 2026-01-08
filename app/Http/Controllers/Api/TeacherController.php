<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Coursecategory;
use App\Models\Teacher;
use App\Models\User;
use Illuminate\Http\Request;

class TeacherController extends Controller
{
    public function index(){
        $teachers = User::with('teacher')->where('role', 'Teacher')->paginate(10);

        $teachers->getCollection()->transform(function ($teacher) {
            $teacher->profile_pic = $teacher->profile_pic ? asset('storage/images/teachers/' . $teacher->profile_pic) : '';
            return $teacher;
        });

        return $this->sendSuccess('Teachers fetched successfully', ['teachers' => $teachers]);
    }
}
