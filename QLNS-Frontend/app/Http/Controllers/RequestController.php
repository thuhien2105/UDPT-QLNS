<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RequestModel;
use App\Notification\Notification;

class RequestController extends Controller
{
    use Notification;
    public function store(Request $request)
    {
        $request->validate([
            'employee_id' => 'required|exists:employees,employee_id',
            'request_type' => 'required|string',
            'request_date' => 'required|date',
            'manager_id' => 'required|exists:employees,employee_id'
        ]);

        $newRequest = RequestModel::create($request->all());
        return response()->json($newRequest, 201);
    }

    public function update(Request $request, $id)
    {
        $requestModel = RequestModel::find($id);

        if (!$requestModel) {
            return response()->json(['error' => 'Request not found'], 404);
        }

        $requestModel->update($request->all());

        return response()->json($requestModel);
    }

    public function show($id)
    {
        $requestModel = RequestModel::findOrFail($id);
        return response()->json($requestModel);
    }

    public function index()
    {
        $requests = RequestModel::all();
        return response()->json($requests);
    }
    public function destroy($id)
    {
        $requestModel = RequestModel::find($id);

        if (!$requestModel) {
            return response()->json(['error' => 'Request not found'], 404);
        }

        $requestModel->delete();

        return response()->json(['message' => 'Request deleted successfully']);
    }
}
