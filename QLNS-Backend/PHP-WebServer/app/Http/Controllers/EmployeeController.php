<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\RabbitMQConnection;
use Illuminate\Support\Facades\Cache;

class EmployeeController extends Controller
{
    private $rabbitMQService;

    public function __construct(RabbitMQConnection $rabbitMQService)
    {
        $this->rabbitMQService = $rabbitMQService;
    }

    public function index(Request $request, $keyword = null, $page = 1)
    {
        $jwtPayload = $request->attributes->get('payload');

        if ($jwtPayload['role'] !== 'manager') {
            return response()->json(['error' => 'You do not have permission to access this resource'], 403);
        }

        $keyword = $keyword === 'null' ? null : $keyword;
        $cacheKey = "employees:{$keyword}:page:{$page}";

        $cachedResponse = Cache::get($cacheKey);

        if ($cachedResponse) {
            return response()->json($cachedResponse);
        }

        $message = json_encode(['action' => 'get_all', 'keyword' => $keyword, 'page' => $page]);
        $response = $this->rabbitMQService->sendToEmployeeQueue($message);

        Cache::put($cacheKey, $response, now()->addMinutes(30));

        return response()->json($response);
    }

    public function show($employee_id, Request $request)
    {
        $user = $request->attributes->get('payload');

        if ($user['role'] === 'manager' || ($user['sub'] == $employee_id)) {
            $cacheKey = "employee:{$employee_id}";

            $cachedResponse = Cache::get($cacheKey);

            if ($cachedResponse) {
                return response()->json($cachedResponse);
            }

            $message = json_encode(['action' => 'get', 'employee_id' => $employee_id]);
            $response = $this->rabbitMQService->sendToEmployeeQueue($message);

            Cache::put($cacheKey, $response, now()->addMinutes(30));

            return response()->json($response);
        }

        return response()->json(['error' => 'You do not have permission to access this resource'], 403);
    }

    public function store(Request $request)
    {
        $user = $request->attributes->get('payload');

        if ($user['role'] !== 'manager') {
            return response()->json(['error' => 'You do not have permission to access this resource'], 403);
        }

        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'dob' => 'nullable|date',
            'address' => 'nullable|string|max:255',
            'email' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'phoneNumber' => 'required|string|max:20',
            'taxCode' => 'required|string|max:20',
            'bankAccount' => 'required|string|max:20',
            'identityCard' => 'required|string|max:20',
            'role' => 'required|string|in:employee,manager'
        ]);
        $message = json_encode(['action' => 'create', 'employee' => $validatedData]);
        $response = $this->rabbitMQService->sendToEmployeeQueue($message);

        Cache::flush();

        return response()->json($response, 201);
    }

    public function update(Request $request)
    {
        $user = $request->attributes->get('payload');

        $validatedData = $request->validate([
            'employeeId' => 'required|string',
            'dob' => 'nullable|date',
            'address' => 'nullable|string|max:255',
            'email' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'phoneNumber' => 'required|string|max:20',
            'taxCode' => 'required|string|max:20',
            'bankAccount' => 'required|string|max:20',
            'identityCard' => 'required|string|max:20',
            'role' => 'required|string|in:employee,manager'
        ]);

        if ($user['role'] === 'manager' || ($user['role'] === 'employee' && $user['sub'] == $validatedData['employee_id'])) {
            $message = json_encode(['action' => 'update', 'employee' => $validatedData]);
            $response = $this->rabbitMQService->sendToEmployeeQueue($message);

            $keys = Cache::getRedis()->keys('employees:*');
            foreach ($keys as $key) {
                Cache::forget($key);
            }


            return response()->json($response);
        }

        return response()->json(['error' => 'You do not have permission to access this resource'], 403);
    }

    public function destroy($employee_id, Request $request)
    {
        $user = $request->attributes->get('payload');

        if ($user['role'] !== 'manager') {
            return response()->json(['error' => 'You do not have permission to access this resource'], 403);
        }

        $message = json_encode(['action' => 'delete', 'employee_id' => $employee_id]);
        $response = $this->rabbitMQService->sendToEmployeeQueue($message);

        $keys = Cache::getRedis()->keys('employees:*');
        foreach ($keys as $key) {
            Cache::forget($key);
        }


        return response()->json($response);
    }

    public function changePassword(Request $request, $employee_id)
    {
        $user = $request->attributes->get('payload');

        $validatedData = $request->validate([
            'old_password' => 'required|string',
            'new_password' => 'required|string|min:8',
        ]);

        $message = json_encode([
            'action' => 'change-password',
            'employee_id' => $user['sub'],
            'old_password' => $validatedData['old_password'],
            'new_password' => $validatedData['new_password'],
        ]);

        $response = $this->rabbitMQService->sendToEmployeeQueue($message);

        Cache::forget("employee:{$employee_id}");

        return response()->json($response);
    }
}
