<?php

namespace App\Http\Controllers\Teacher\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLoginForm(){
        return view('teacher.auth.login-form');
    }

    public function login(Request $request){
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if(Auth::attempt([
                            'email' => $request->email, 
                            'password' => $request->password, 
                            'role' => 'Teacher', 
                            'status' => 'Active'
                        ])){
            $request->session()->regenerate();

            return response()->json([
                                        'message' => 'Logged in successfully', 
                                        'redirect_url' => redirect()->intended(route('teacher.dashboard'))->getTargetUrl()
                                    ]);
        }else{
            return response()->json(['message' => 'Invalid email or password.'], 422);
        }
    }

    public function logout(){
        Auth::logout();
        return response()->json(['message' => 'Logged out successfully.', 'redirect_url' => route('teacher.login')]);
    }
}
