<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Traits\JwtTokenTrait;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    use JwtTokenTrait;

    public function login(Request $request){
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required'
        ]);

        $user = User::where('email', $request->email)->where('role', 'Student')->first();

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

    public function refresh(Request $request){
        $token = $request->bearerToken();

        if (! $token) {
            return response()->json(['message' => 'Token missing'], 401);
        }

        try{
            $payload = $this->checkAuthToken($token);

            if(!$user = User::find($payload->sub)){
                throw new \Exception('User not found');
            }

            $jwtToken = $this->generateAuthToken($user);

            return $this->sendSuccess('Logged in successfully', [
                                                                    'token' => $jwtToken['token'],
                                                                    'expires_at' => $jwtToken['expires_at']
                                                                ]);
        }catch(\Exception $e){
            return response()->json(['message' => $e->getMessage()], 401);
        }
    }

}
