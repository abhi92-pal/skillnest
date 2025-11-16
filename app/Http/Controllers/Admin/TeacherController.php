<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use App\Models\User;
use Illuminate\Support\Facades\Hash;


class TeacherController extends Controller
{
    public function index(Request $request){

        $teachers = User::where('role', 'Teacher')->get();
        return view('admin.teacher.index',compact('teachers'));
    }

    public function create(){
        return view('admin.teacher.create');
    }

    public function store(Request $request){
        $validator = Validator::make($request->all(), 
        [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'profile_pic' => 'required|mimes:jpg,jpeg,png,webp|max:2048',
        ], [
            'required' => 'This field is required.'
        ], []);

        if ($validator->fails()) {
            $validator_error_msg = $validator->getMessageBag()->toArray();
            $errors = [];
            foreach ($validator_error_msg as $attribute => $validator_error) {
                $attribute = str_replace('.', '_', $attribute);
                $errors[$attribute] = $validator_error;
            }
            
            return response()->json(['errors' => $errors, 'message' => 'Please fill with valid data.'], 422);
        }

        $path = null;

        if($request->hasFile('profile_pic')){
            $filename = time() . '.' . $request->profile_pic->extension();
            $path = $request->profile_pic->storeAs('images/teachers', $filename, 'public');
        }

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'profile_pic' => $filename,
            'role' => 'Teacher',
            'password' => Hash::make('000000'), // Set a default password or generate one
        ]);
        return response()->json(['success' => true, 'message' => 'Teacher created successfully.'],200);
    }
}
