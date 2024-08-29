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

            if (is_array($response)) {
                $response = json_encode($response);
            }

            $responseData = json_decode($response, true);

            if (isset($responseData['error'])) {
                $errorMessage = $responseData['error'] ?? 'Unknown error';
                return response()->json(['status' => 'Error', 'error' => $errorMessage], 400);
            }

            return response()->json(['response' => $responseData]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'An error occurred: ' . $e->getMessage()], 500);
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
