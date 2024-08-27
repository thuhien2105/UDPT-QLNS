<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use App\Notification\Notification;
use Illuminate\Support\Facades\Http;

class EmployeeController extends Controller
{
    use Notification;
    public function index()
    {
        $employees = Employee::all();
        return response()->json($employees);
    }

    public function show($id)
    {
        $employee = Employee::find($id);

        if (!$employee) {
            return response()->json(['message' => 'Employee not found'], 404);
        }

        return response()->json($employee);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'dob' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'phone_number' => 'required|string|max:255',
        ]);

        $employee = Employee::create($validatedData);

        return response()->json($employee, 201);
    }

    public function update(Request $request, $id)
    {
        $employee = Employee::find($id);

        if (!$employee) {
            return response()->json(['message' => 'Employee not found'], 404);
        }

        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'dob' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'phone_number' => 'required|string|max:255',
        ]);

        $employee->update($validatedData);

        return response()->json($employee);
    }

    public function destroy($id)
    {
        $employee = Employee::find($id);

        if (!$employee) {
            return response()->json(['message' => 'Employee not found'], 404);
        }

        $employee->delete();

        return response()->json(['message' => 'Employee deleted successfully']);
    }

    public function getFormPage()
    {
        return view('page.employees.form.index');
    }
    public function getListPage()
    {
        return view('page.employees.list.index');
    }
    public function getCheckinoutPage()
    {
        $is_checkin = false;
        if ($is_checkin) {
            return view('page.checkinout.checkout.index');
        }
        return view('page.checkinout.checkin.index');
    }
    public function checkIn(Request $request)
{
    // Validate the request
    $validated = $request->validate([
        'employee_id' => 'required|string|max:255',
    ]);

    // Retrieve the employee ID from validated data
    $employeeId = $validated['employee_id'];

    try {
        $response = Http::withToken(session('token'))->post('http://127.0.0.1:8000/api/request/checkin', [
            'employee_id' => $employeeId,
        ]);
        if ($response->successful()) {
            return response()->json([
                'success' => true,
                'message' => $response->body(),
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Cannot check in! Status code: ' . $response->status() . ', Error: ' . $response->body(),
            ], $response->status());
        }
    } catch (\Exception $e) {
        return response()->json([
            'success' => false,
            'message' => 'Exception occurred: ' . $e->getMessage(),
        ], 500);
    }
}


    public function checkOut(Request $request)
    {
        return response()->json([
            'success' => true,
            'message' => 'Checked Out successfully!',
        ]);
    }

    public function getCheckinoutManagerPage()
    {
        return view('page.checkinout.manager.index');
    }

    public function getCreatePage()
    {
        return view('page.employees.add.index');
    }
    public function createEmployee(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'dob' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'phone_number' => 'required|string|max:255',
        ]);

        $response = Http::post('http://127.0.0.1:8000/api/employees', [
            'name' => $validated['name'],
            'dob' => $validated['dob'],
            'address' => $validated['address'],
            'phone_number' => $validated['phone_number'],
        ]);

        if ($response->successful()) {
            return response()->json([
                'success' => true,
                'message' => 'Successfully!',
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Error!',
            ]);
        }
    }
    public function editEmployee(Request $request,$id)
    {
        $validated = $request->validate([
            'id' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            'dob' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'phone_number' => 'required|string|max:255',
        ]);

        try {
            $response = Http::withToken(session('token'))->put('http://127.0.0.1:8000/api/employees/' . $validated['id'], [
                'id' => $validated['id'],
                'name' => $validated['name'],
                'dob' => $validated['dob'],
                'address' => $validated['address'],
                'phone_number' => $validated['phone_number'],
            ]);

            if ($response->successful()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Successfully updated employee!',
                ]);
            } else {
                return response()->json(
                    [
                        'success' => false,
                        'message' => 'Error updating employee: ' . $response->body(),
                    ],
                    $response->status(),
                );
            }
        } catch (\Exception $e) {
            return response()->json(
                [
                    'success' => false,
                    'message' => 'Exception occurred: ' . $e->getMessage(),
                ],
                500,
            );
        }
    }
}
