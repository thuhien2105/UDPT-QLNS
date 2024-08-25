<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\RabbitMQConnection;
use Illuminate\Support\Facades\Log;

class RequestController extends Controller
{
    private $rabbitMQService;

    public function __construct(RabbitMQConnection $rabbitMQService)
    {
        $this->rabbitMQService = $rabbitMQService;
    }

    public function index()
    {
        $message = json_encode(['action' => 'get_all']);
        $response = $this->rabbitMQService->sendToRequestQueue($message);
        return response()->json($response);
    }

    public function show($id)
    {
        $message = json_encode(['action' => 'get', 'id' => $id]);
        $response = $this->rabbitMQService->sendToRequestQueue($message);
        return response()->json($response);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'type' => 'required|string',
            'employee_id' => 'required|integer',
            'details' => 'required|string',
        ]); 
    
        $message = json_encode(['action' => 'create', 'request' => $validatedData]);
        $response = $this->rabbitMQService->sendToRequestQueue($message);
        return response()->json($response, 201);
    }

    public function update(Request $request)
    {
        $validatedData = $request->validate([
            'id' => 'required|integer',
            'type' => 'required|string',
            'details' => 'required|string',
        ]);

        $message = json_encode(['action' => 'update', 'request' => $validatedData]);
        $response = $this->rabbitMQService->sendToRequestQueue($message);
        return response()->json($response);
    }

    public function destroy($id)
    {
        $message = json_encode(['action' => 'delete', 'id' => $id]);
        $response = $this->rabbitMQService->sendToRequestQueue($message);
        return response()->json($response);
    }
}