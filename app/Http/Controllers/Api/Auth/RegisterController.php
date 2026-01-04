<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Traits\JwtTokenTrait;
use Illuminate\Support\Facades\DB;

class RegisterController extends Controller
{
    use JwtTokenTrait;

    public function register(Request $request){
        $request->validate([
            'name'    => 'required',
            'phone'    => 'required|numeric|digits:10',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|confirmed',
        ]);

        $user = NULL;
        try{
            DB::transaction(function() use ($request, &$user){
                $user = User::create([
                    'role' => 'Student',
                    'name' => $request->name,
                    'email' => $request->email,
                    'phone' => $request->phone,
                    'password' => Hash::make($request->password),
                ]);

                $user->student()->create([
                    'reg_no' => 'SN' . date('Ym') . rand(1000, 99999)
                ]);
            });
        }catch(\Exception $e){
            return $this->sendError($e->getMessage());
        }

        $jwtToken = $this->generateAuthToken($user);

        return $this->sendSuccess('Registration is successful', [
                                                                'token' => $jwtToken['token'],
                                                                'expires_at' => $jwtToken['expires_at']
                                                            ]);
    }
}
