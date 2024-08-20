<?php

namespace App\Http\Controllers;

use App\Services\EmployeeService;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    protected $employeeService;

    public function __construct(EmployeeService $employeeService)
    {
        $this->employeeService = $employeeService;
    }

    public function createEmployee(Request $request)
    {
        $data = $request->all();

        $this->employeeService->createEmployee($data);

        return response()->json(['message' => 'Employee creation request sent']);
    }

    public function updateEmployee(Request $request, $id)
    {
        $data = $request->all();
        $data['id'] = $id;

        $this->employeeService->updateEmployee($data);

        return response()->json(['message' => 'Employee update request sent']);
    }

    public function deleteEmployee($id)
    {
        $this->employeeService->deleteEmployee($id);

        return response()->json(['message' => 'Employee delete request sent']);
    }
}