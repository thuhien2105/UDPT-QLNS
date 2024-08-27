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
        Log::info('Incoming request:', [
            'url' => $request->url(),
            'method' => $request->method(),
            'headers' => $request->headers->all(),
            'body' => $request->all()
        ]);

        $token = $request->bearerToken();

        if (!$token) {
            return response()->json(['error' => 'Token không được cung cấp'], 401);
        }

        try {
            $decoded = JWT::decode($token, new Key($this->secretKey, 'HS256'));
            $jwtPayload = (array) $decoded;

            Log::info('Decoded JWT Token:', $jwtPayload);

            if ($jwtPayload['role'] !== 'manager') {
                return response()->json(['error' => 'Unauthorized'], 403);
            }

            Log::info('User Role:', ['role' => $jwtPayload['role']]);

            $request->attributes->set('jwt_payload', $jwtPayload);

            return $next($request);
        } catch (\Exception $e) {
            Log::error('Token không hợp lệ: ' . $e->getMessage());
            return response()->json(['error' => 'Token không hợp lệ'], 401);
        }
    }
}
