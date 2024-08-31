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
    public function getCheckinoutPage(Request $request)
    {
        $is_checkin = $request->session()->get('checkin') || $request->query('checkin');
        if ($is_checkin) {
            return view('page.checkinout.checkout.index');
        }
        return view('page.checkinout.checkin.index');
    }
    public function checkIn(Request $request)
    {
        $validated = $request->validate([
            'employee_id' => 'required|string|max:255',
        ]);
        $employeeId = $validated['employee_id'];

        try {
            $response = Http::withToken(session('token'))->post('http://127.0.0.1:8000/api/request/timesheet/checkin', [
                'employee_id' => $employeeId,
            ]);
            if ($response->successful()) {
                $request->session()->put('checkin', true);
                return response()->json([
                    'success' => true,
                    'message' => $response->body(),
                ]);
            } else {
                return response()->json(
                    [
                        'success' => false,
                        'message' => 'Cannot 1! Status code: ' . $response->status() . ', Error: ' . $response->body(),
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

    public function checkOut(Request $request)
    {
        $validated = $request->validate([
            'employee_id' => 'required|string|max:255',
        ]);
        $employeeId = $validated['employee_id'];

        try {
            $response = Http::withToken(session('token'))->post('http://127.0.0.1:8000/api/request/timesheet/checkout', [
                'employee_id' => $employeeId,
            ]);
            if ($response->successful()) {
                $request->session()->put('checkin', false);
                return response()->json([
                    'success' => true,
                    'message' => $response->body(),
                ]);
            } else {
                return response()->json(
                    [
                        'success' => false,
                        'message' => 'Cannot check out! Status code: ' . $response->status() . ', Error: ' . $response->body(),
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
            'dob' => 'nullable|date',
            'address' => 'nullable|string|max:255',
            'email' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'phone_number' => 'required|string|max:20',
            'tax_code' => 'required|string|max:20',
            'bank_account' => 'required|string|max:20',
            'identity_card' => 'required|string|max:20',
            'role' => 'required|string|in:employee,manager'
        ]);

        $response = Http::withToken(session('token'))->post('http://127.0.0.1:8000/api/employees', [
            'name' => $validated['name'],
            'dob' => $validated['dob'],
            'address' => $validated['address'],
            'phone_number' => $validated['phone_number'],
            'email' => $validated['email'],
            'position' => $validated['position'],
            'tax_code' => $validated['tax_code'],
            'bank_account' => $validated['bank_account'],
            'identity_card' => $validated['identity_card'],
            'role' => $validated['role'],
        ]);

        if ($response->successful()) {
            return response()->json([
                'success' => true,
                'message' => 'Successfully!',
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Error!' . $response->body(),
            ]);
        }
    }
    public function editEmployee(Request $request)
    {
        $validated = $request->validate([
            'id' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            'dob' => 'nullable|date',
            'address' => 'nullable|string|max:255',
            'email' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'phone_number' => 'required|string|max:20',
            'tax_code' => 'required|string|max:20',
            'bank_account' => 'required|string|max:20',
            'identity_card' => 'required|string|max:20',
            'role' => 'required|string|in:employee,manager'
        ]);

        try {
            $response = Http::withToken(session('token'))->put('http://127.0.0.1:8000/api/employees/' . $validated['id'], [
                'id' => $validated['id'],
                'name' => $validated['name'],
                'dob' => $validated['dob'],
                'address' => $validated['address'],
                'phone_number' => $validated['phone_number'],
                'email' => $validated['email'],
                'position' => $validated['position'],
                'tax_code' => $validated['tax_code'],
                'bank_account' => $validated['bank_account'],
                'identity_card' => $validated['identity_card'],
                'role' => $validated['role'],
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
