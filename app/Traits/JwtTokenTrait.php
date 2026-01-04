<?php

namespace App\Traits;

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

trait JwtTokenTrait
{
    public function generateAuthToken($user){
        $expires_at = time() + env('JWT_EXPIRE');
        $payload = [
            'iss' => config('app.url'),
            'sub' => $user->id,
            'email' => $user->email,
            'iat' => time(),
            'exp' => $expires_at,
        ];

        $jwt = JWT::encode($payload, env('JWT_SECRET'), 'HS256');
        
        // return ['token' => $jwt, 'expires_at' => date('Y-m-d H:i:s', $expires_at)];
        return ['token' => $jwt, 'expires_at' => $expires_at];
    }

    public function checkAuthToken($token){
        try {
            $decoded = JWT::decode($token, new Key(env('JWT_SECRET'), 'HS256'));
            return $decoded;
        } 
        catch (\Exception $e) {
            throw new \Exception('Invalid token');
        }
    }
}
