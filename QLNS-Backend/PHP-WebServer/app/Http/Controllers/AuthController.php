<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\RabbitMQConnection;

class AuthController extends Controller
{
    private $rabbitMQService;

    public function __construct(RabbitMQConnection $rabbitMQService)
    {
        $this->rabbitMQService = $rabbitMQService;
    }

    public function register(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $message = [
            'action' => 'register',
            'user' => $validatedData
        ];

        $response = $this->rabbitMQService->sendToEmployeeQueue($message);
        return response()->json(['message' => 'Registration request sent to RabbitMQ', 'response' => $response]);
    }

    public function login(Request $request)
    {
        $validatedData = $request->validate([
            'email' => 'required|string|email|max:255',
            'password' => 'required|string|min:8',
        ]);

        $message = [
            'action' => 'login',
            'user' => $validatedData
        ];

        $response = $this->rabbitMQService->sendToEmployeeQueue($message);
        return response()->json(['message' => 'Login request sent to RabbitMQ', 'response' => $response]);
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
