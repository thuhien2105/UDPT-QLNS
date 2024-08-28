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
            'employee_id' => $employeeId,
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
            'employee_id' => $employeeId,
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

        $user = $request->attributes->get('jwt_payload');

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
            'request_type' => 'required|string',
            'start_time' => 'required|date',
            'end_time' => 'required|date',
            'reason' => 'nullable|string|max:255',
        ]);

        $validatedData['employee_id'] = $user['sub'];

        $message = json_encode(['action' => 'create', 'request' => $validatedData]);

        $response = $this->rabbitMQService->sendToRequestQueue($message);

        if (is_array($response)) {
            $response = json_encode($response);
        }

        $responseData = json_decode($response, true);

        if (isset($responseData['status']) && $responseData['status'] === 'error') {
            $errorMessage = isset($responseData['message']) ? $responseData['message'] : 'Unknown error occurred';
            return response()->json(['error' => $errorMessage], 400);
        }

        return response()->json($responseData, 201);
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
        $user = $request->attributes->get('jwt_payload');

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
        $user = $request->attributes->get('jwt_payload');

        $message = json_encode(['action' => 'delete', 'id' => $id]);
        $response = $this->rabbitMQService->sendToRequestQueue($message);
        return response()->json($response);
    }

    public function approve(Request $request, $id)
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
            'status' => 'required|string|in:PENDING,APPROVED,REJECTED'
        ]);

        $message = json_encode([
            'action' => 'approve',
            'manager_id' => $user['sub'],
            'id' => $id,
            'status' => $validatedData['status']
        ]);

        try {
            $response = $this->rabbitMQService->sendToRequestQueue($message);

            if (isset($response['status']) && $response['status'] === 'error') {
                return response()->json(['error' => 'Failed to approve request: ' . $response['message']], 500);
            }

            return response()->json(['response' => $response]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'An error occurred: ' . $e->getMessage()], 500);
        }
    }
}
