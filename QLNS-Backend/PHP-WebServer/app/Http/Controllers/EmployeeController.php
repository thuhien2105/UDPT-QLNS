<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use App\RabbitMQConnection;
use Illuminate\Support\Facades\Log;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class EmployeeController extends Controller
{
    private $rabbitMQService;
    private $secretKey = 'ungdungphantan_hcmus_20clcbytranthuhien';

    public function __construct(RabbitMQConnection $rabbitMQService)
    {
        $this->rabbitMQService = $rabbitMQService;
    }

    private function verifyToken(Request $request)
    {
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

            $request->attributes->set('jwt_payload', $jwtPayload);

            return null;
        } catch (\Exception $e) {
            Log::error('Token không hợp lệ: ' . $e->getMessage());
            return response()->json(['error' => 'Token không hợp lệ'], 401);
        }
    }



    public function index(Request $request)
    {
        $response = $this->verifyToken($request);
        if ($response) {
            return $response;
        }

        $message = json_encode(['action' => 'get_all']);
        $response = $this->rabbitMQService->sendToEmployeeQueue($message);

        return response()->json($response);
    }

    public function show($id, Request $request)
    {
        $response = $this->verifyToken($request);
        if ($response) {
            return $response;
        }

        $user = $request->attributes->get('jwt_payload');

        if ($user['role'] === 'manager' || ($user['role'] === 'employee' && $user['sub'] == $id)) {
            $message = json_encode(['action' => 'get', 'id' => $id]);
            $response = $this->rabbitMQService->sendToEmployeeQueue($message);
            return response()->json($response);
        }

        return response()->json(['error' => 'Unauthorized'], 403);
    }

    public function store(Request $request)
    {
        $response = $this->verifyToken($request);
        if ($response) {
            return $response;
        }

        $user = $request->attributes->get('jwt_payload');

        if ($user['role'] !== 'manager') {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

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
        $response = $this->verifyToken($request);
        if ($response) {
            return $response;
        }

        $user = $request->attributes->get('jwt_payload');

        $validatedData = $request->validate([
            'id' => 'required|integer',
            'name' => 'required|string|max:255',
            'dob' => 'required|date',
            'address' => 'required|string|max:255',
            'phone_number' => 'required|string|max:20',
        ]);

        if ($user['role'] === 'manager' || ($user['role'] === 'employee' && $user['sub'] == $validatedData['id'])) {
            $message = json_encode(['action' => 'update', 'employee' => $validatedData]);
            $response = $this->rabbitMQService->sendToEmployeeQueue($message);
            return response()->json($response);
        }

        return response()->json(['error' => 'Unauthorized'], 403);
    }

    public function destroy($id, Request $request)
    {
        $response = $this->verifyToken($request);
        if ($response) {
            return $response;
        }

        $user = $request->attributes->get('jwt_payload');

        if ($user['role'] !== 'manager') {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $message = json_encode(['action' => 'delete', 'id' => $id]);
        $response = $this->rabbitMQService->sendToEmployeeQueue($message);
        return response()->json($response);
    }
}
