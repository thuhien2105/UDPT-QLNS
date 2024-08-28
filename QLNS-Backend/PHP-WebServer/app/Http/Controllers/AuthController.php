<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use App\Models\User;
use App\RabbitMQConnection;

class AuthController extends Controller
{
    private $rabbitMQService;
    public function __construct(RabbitMQConnection $rabbitMQService)
    {
        $this->rabbitMQService = $rabbitMQService;
    }

    public function signin(Request $request)
    {


        try {
            $validatedData = $request->validate([
                'username' => 'required|string',
                'password' => 'required|string|min:8',
            ]);

            $message = json_encode([
                'action' => 'login',
                'username' => $validatedData['username'],
                'password' => $validatedData['password'],
            ]);
            $response = $this->rabbitMQService->sendToEmployeeQueue($message);

            return response()->json(['response' => $response]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'An error occurred'], 500);
        }
    }

    public function logout(Request $request)
    {
        $request->validate([
            'token' => 'required|string',
        ]);

        $message = [
            'action' => 'logout',
            'token' => $request->token,
        ];

        $response = $this->rabbitMQService->sendToEmployeeQueue($message);
        return response()->json(['message' => 'Logout request sent to RabbitMQ', 'response' => $response]);
    }
}