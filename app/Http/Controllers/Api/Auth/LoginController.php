<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Traits\JwtTokenTrait;

class LoginController extends Controller
{
    use JwtTokenTrait;

    public function login(Request $request){
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required'
        ]);

        $user = User::where('email', $request->email)->first();

        if (! $user || ! Hash::check($request->password, $user->password)) {
            return response()->json([
                'message' => 'Invalid email or password.'
            ], 401);
        }

        $jwtToken = $this->generateAuthToken($user);

        return $this->sendSuccess('Logged in successfully', [
                                                                'token' => $jwtToken['token'],
                                                                'expires_at' => $jwtToken['expires_at']
                                                            ]);
    }
}
