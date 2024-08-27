<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\RabbitMQConnection;
use Illuminate\Support\Facades\Log;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class RequestController extends Controller
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
            return response()->json(['error' => 'Token not provided'], 401);
        }

        try {
            $decoded = JWT::decode($token, new Key($this->secretKey, 'HS256'));
            $jwtPayload = (array) $decoded;

            Log::info('Decoded JWT Token:', $jwtPayload);

            $request->attributes->set('jwt_payload', $jwtPayload);

            return null;
        } catch (\Exception $e) {
            Log::error('Invalid token: ' . $e->getMessage());
            return response()->json(['error' => 'Invalid token'], 401);
        }
    }

    public function index(Request $request, $page)
    {
        $response = $this->verifyToken($request);
        if ($response) {
            return $response;
        }

        $user = $request->attributes->get('jwt_payload');

        if ($user['role'] !== 'manager') {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $message = json_encode(['action' => 'get_all', 'page' => $page]);
        $response = $this->rabbitMQService->sendToRequestQueue($message);
        return response()->json($response);
    }

    public function showRequestByEmployee(Request $request, $employeeId, $page, $month, $year)
    {
        $response = $this->verifyToken($request);
        if ($response) {
            return $response;
        }

        $user = $request->attributes->get('jwt_payload');

        if ($user['role'] !== 'manager' && $user['sub'] !== $employeeId) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $message = json_encode([
            'action' => 'get_request_by_employee',
            'employeeId' => $employeeId,
            'page' => $page,
            'month' => $month,
            'year' => $year
        ]);
        $response = $this->rabbitMQService->sendToRequestQueue($message);
        return response()->json($response);
    }
    public function showTimeSheetByEmployee(Request $request, $employeeId, $page, $month, $year)
    {
        $response = $this->verifyToken($request);
        if ($response) {
            return $response;
        }

        $user = $request->attributes->get('jwt_payload');

        if ($user['role'] !== 'manager' && $user['sub'] !== $employeeId) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $message = json_encode([
            'action' => 'get_time_sheet_by_employee',
            'employeeId' => $employeeId,
            'page' => $page,
            'month' => $month,
            'year' => $year
        ]);
        $response = $this->rabbitMQService->sendToRequestQueue($message);
        return response()->json($response);
    }
    public function showById(Request $request, $id,  $page, $month, $year)
    {
        $response = $this->verifyToken($request);
        if ($response) {
            return $response;
        }


        $message = json_encode(['action' => 'get_by_id', 'id' => $id]);
        $response = $this->rabbitMQService->sendToRequestQueue($message);
        return response()->json($response);
    }

    public function store(Request $request)
    {
        $response = $this->verifyToken($request);
        if ($response) {
            return $response;
        }

        $user = $request->attributes->get('jwt_payload');

        $request->merge(['employee_id' => $user['sub']]);

        $validatedData = $request->validate([
            'employee_id' => ['required', 'string'],
            'request_type' => 'required|string',

            'request_date' => 'required|date',
            'start_time' => 'nullable|date',
            'end_time' => 'nullable|date',

            'reason' => 'nullable|string|max:255',
            'approver_id' => 'nullable|date',
            'status' => 'required|string|in:pending,approved,rejected'
        ]);

        $message = json_encode(['action' => 'create', 'request' => $validatedData]);
        $response = $this->rabbitMQService->sendToRequestQueue($message);
        return response()->json($response, 201);
    }

    public function checkin(Request $request)
    {
        $response = $this->verifyToken($request);
        if ($response) {
            return $response;
        }

        $user = $request->attributes->get('jwt_payload');


        $message = json_encode(['action' => 'check-in', 'employee_id' => $user['sub']]);
        $response = $this->rabbitMQService->sendToRequestQueue($message);
        return response()->json($response);
    }

    public function checkout(Request $request)
    {
        $response = $this->verifyToken($request);
        if ($response) {
            return $response;
        }

        $user = $request->attributes->get('jwt_payload');



        $message = json_encode(['action' => 'check-out', 'employee_id' => $user['sub']]);
        $response = $this->rabbitMQService->sendToRequestQueue($message);
        return response()->json($response);
    }
    public function update(Request $request, $id)
    {
        $response = $this->verifyToken($request);
        if ($response) {
            return $response;
        }

        $validatedData = $request->validate([
            'request_type' => 'sometimes|required|string',
            'request_date' => 'sometimes|required|date',
            'start_time' => 'sometimes|nullable|date',
            'end_time' => 'sometimes|nullable|date',
            'reason' => 'sometimes|nullable|string|max:255',
            'approver_id' => 'sometimes|nullable|integer',
            'status' => 'sometimes|required|string|in:pending,approved,rejected'
        ]);

        $validatedData['id'] = $id;

        $message = json_encode(['action' => 'update', 'request' => $validatedData]);

        $response = $this->rabbitMQService->sendToRequestQueue($message);

        return response()->json($response);
    }


    public function destroy(Request $request, $id)
    {
        $response = $this->verifyToken($request);
        if ($response) {
            return $response;
        }

        $message = json_encode(['action' => 'delete', 'id' => $id]);
        $response = $this->rabbitMQService->sendToRequestQueue($message);
        return response()->json($response);
    }
}
