<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use App\RabbitMQConnection;
use Illuminate\Support\Facades\Log;

class EmployeeController extends Controller
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

    public function signin(Request $request)
    {
        Log::info('Signin method called');
        Log::info('Request data:', $request->all());

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
            Log::error('Signin method error:', ['error' => $e->getMessage()]);
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
    public function index()
    {

        $message = json_encode(['action' => 'get_all']);
        $response = $this->rabbitMQService->sendToEmployeeQueue($message);
        return response()->json($response);
    }

    public function show($id)
    {
        $message = json_encode(['action' => 'get', 'id' => $id]);
        $response = $this->rabbitMQService->sendToEmployeeQueue($message);
        return response()->json($response);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'dob' => 'required|date',
            'address' => 'required|string|max:255',
            'phone_number' => 'required|string|max:20',
        ]);
        $message = json_encode(['action' => 'create', 'employee' => $validatedData]);
        $response = $this->rabbitMQService->sendToEmployeeQueue($message);
        return response()->json($response, 201);
    }

    public function update(Request $request)
    {
        $validatedData = $request->validate([
            'id' => 'required|integer',
            'name' => 'required|string|max:255',
            'dob' => 'required|date',
            'address' => 'required|string|max:255',
            'phone_number' => 'required|string|max:20',
        ]);

        $message = json_encode(['action' => 'update', 'employee' => $validatedData]);
        $response = $this->rabbitMQService->sendToEmployeeQueue($message);
        return response()->json($response);
    }

    public function destroy($id)
    {
        $message = json_encode(['action' => 'delete', 'id' => $id]);
        $response = $this->rabbitMQService->sendToEmployeeQueue($message);
        return response()->json($response);
    }
}
