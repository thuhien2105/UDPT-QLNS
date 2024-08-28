<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\RabbitMQConnection;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class RequestController extends Controller
{
    private $rabbitMQService;

    public function __construct(RabbitMQConnection $rabbitMQService)
    {
        $this->rabbitMQService = $rabbitMQService;
    }

    public function index(Request $request, $page)
    {
        $user = $request->attributes->get('payload');

        if ($user['role'] !== 'manager') {
            return response()->json(['error' => 'You do not have permission to access this resource'], 403);
        }

        $cacheKey = "requests:page:{$page}";
        $cachedResponse = Cache::get($cacheKey);

        if ($cachedResponse) {
            return response()->json($cachedResponse);
        }

        $message = json_encode(['action' => 'get_all', 'page' => $page]);
        $response = $this->rabbitMQService->sendToRequestQueue($message);

        Cache::put($cacheKey, $response, now()->addMinutes(30));

        return response()->json($response);
    }

    public function showRequestByEmployee(Request $request, $employeeId, $page, $month, $year)
    {
        $user = $request->attributes->get('payload');

        if ($user['role'] !== 'manager' && $user['sub'] !== $employeeId) {
            return response()->json(['error' => 'You do not have permission to access this resource'], 403);
        }

        $cacheKey = "requests:employee:{$employeeId}:page:{$page}:month:{$month}:year:{$year}";
        $cachedResponse = Cache::get($cacheKey);

        if ($cachedResponse) {
            return response()->json($cachedResponse);
        }

        $message = json_encode([
            'action' => 'get_request_by_employee',
            'employee_id' => $employeeId,
            'page' => $page,
            'month' => $month,
            'year' => $year
        ]);
        $response = $this->rabbitMQService->sendToRequestQueue($message);

        Cache::put($cacheKey, $response, now()->addMinutes(30));

        return response()->json($response);
    }

    public function showTimeSheetByEmployee(Request $request, $employeeId, $page, $month, $year)
    {
        $user = $request->attributes->get('payload');

        if ($user['role'] !== 'manager' && $user['sub'] !== $employeeId) {
            return response()->json(['error' => 'You do not have permission to access this resource'], 403);
        }

        $cacheKey = "time_sheets:employee:{$employeeId}:page:{$page}:month:{$month}:year:{$year}";
        $cachedResponse = Cache::get($cacheKey);

        if ($cachedResponse) {
            return response()->json($cachedResponse);
        }

        $message = json_encode([
            'action' => 'get_time_sheet_by_employee',
            'employee_id' => $employeeId,
            'page' => $page,
            'month' => $month,
            'year' => $year
        ]);
        $response = $this->rabbitMQService->sendToRequestQueue($message);

        Cache::put($cacheKey, $response, now()->addMinutes(30));

        return response()->json($response);
    }

    public function showById(Request $request, $id, $page, $month, $year)
    {
        $user = $request->attributes->get('payload');

        $cacheKey = "requests:id:{$id}:page:{$page}:month:{$month}:year:{$year}";
        $cachedResponse = Cache::get($cacheKey);

        if ($cachedResponse) {
            return response()->json($cachedResponse);
        }

        $message = json_encode(['action' => 'get_by_id', 'id' => $id]);
        $response = $this->rabbitMQService->sendToRequestQueue($message);

        Cache::put($cacheKey, $response, now()->addMinutes(30));

        return response()->json($response);
    }

    public function store(Request $request)
    {
        $user = $request->attributes->get('payload');

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
        $user = $request->attributes->get('payload');

        $message = json_encode(['action' => 'check-in', 'employee_id' => $user['sub']]);
        $response = $this->rabbitMQService->sendToRequestQueue($message);
        return response()->json($response);
    }

    public function checkout(Request $request)
    {
        $user = $request->attributes->get('payload');

        $message = json_encode(['action' => 'check-out', 'employee_id' => $user['sub']]);
        $response = $this->rabbitMQService->sendToRequestQueue($message);
        return response()->json($response);
    }

    public function update(Request $request, $id)
    {
        $user = $request->attributes->get('payload');

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
        $user = $request->attributes->get('payload');

        $message = json_encode(['action' => 'delete', 'id' => $id]);
        $response = $this->rabbitMQService->sendToRequestQueue($message);
        return response()->json($response);
    }

    public function approve(Request $request, $id)
    {
        $user = $request->attributes->get('payload');

        if ($user['role'] !== 'manager') {
            return response()->json(['error' => 'You do not have permission to access this resource'], 403);
        }

        $validatedData = $request->validate([
            'status' => 'required|string|in:APPROVED,REJECTED'
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
