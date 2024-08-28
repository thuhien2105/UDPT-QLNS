<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Illuminate\Support\Facades\Log;

class JwtAuthMiddleware
{
    private $secretKey = 'ungdungphantan_hcmus_20clcbytranthuhien';

    public function handle(Request $request, Closure $next)
    {
        $token = $request->bearerToken();

        if (!$token) {
            return response()->json(['error' => 'Token not provided'], 401);
        }

        try {
            $decoded = JWT::decode($token, new Key($this->secretKey, 'HS256'));
            $jwtPayload = (array) $decoded;

            Log::info('Decoded JWT Token:', $jwtPayload);
            $request->attributes->set('payload', $jwtPayload);

            return $next($request);
        } catch (\Exception $e) {
            Log::error('Invalid token: ' . $e->getMessage());
            return response()->json(['error' => 'Invalid token'], 401);
        }
    }
}
