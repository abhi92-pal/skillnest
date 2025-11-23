<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Traits\JwtTokenTrait;
use Illuminate\Support\Facades\Auth;

class ApiAuthenticationMiddleware
{
    use JwtTokenTrait;
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $token = $request->bearerToken();

        if (! $token) {
            return response()->json(['message' => 'Token missing'], 401);
        }

        try{
            $payload = $this->checkAuthToken($token);

            Auth::loginUsingId($payload->sub);
        }catch(\Exception $e){
            return response()->json(['message' => $e->getMessage()], 401);
        }

        return $next($request);
    }
}
