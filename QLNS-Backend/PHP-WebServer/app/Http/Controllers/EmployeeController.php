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

    public function index()
    {
        $message = json_encode(['action' => 'get_all']);
        $response = $this->rabbitMQService->send($message);
        return response()->json($response);
    }
    public function show($id)
    {
        $message = json_encode(['action' => 'get', 'id' => $id]);
        $response = $this->rabbitMQService->send($message);
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

        $employee = Employee::create($validatedData);
        $message = json_encode(['action' => 'create', 'employee' => $employee]);
        $response = $this->rabbitMQService->send($message);
        return response()->json($response, 201);
    }

    public function update(Request $request, $id)
    {
        $employee = Employee::find($id);
        if (!$employee) {
            return response()->json(['message' => 'Employee not found'], 404);
        }

        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'dob' => 'required|date',
            'address' => 'required|string|max:255',
            'phone_number' => 'required|string|max:20',
        ]);

        $employee->update($validatedData);
        $message = json_encode(['action' => 'update', 'id' => $id, 'employee' => $employee]);
        $response = $this->rabbitMQService->send($message);
        return response()->json($response);
    }

    public function destroy($id)
    {
        $employee = Employee::find($id);
        if (!$employee) {
            return response()->json(['message' => 'Employee not found'], 404);
        }

        $employee->delete();
        $message = json_encode(['action' => 'delete', 'id' => $id]);
        $response = $this->rabbitMQService->send($message);
        return response()->json($response);
    }

}