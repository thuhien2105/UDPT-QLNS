<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use App\Notification\Notification;

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
        // Xác thực dữ liệu từ form
        $request->validate([
            'csrf_token' => 'required|string',
        ]);

        // Xử lý logic Check In ở đây
        // Ví dụ: Ghi nhận vào cơ sở dữ liệu hoặc gửi đến API bên ngoài

        return response()->json([
            'success' => true,
            'message' => 'Checked in successfully!',
        ]);
    }

    public function checkOut(Request $request)
    {
        $request->validate([
            'csrf_token' => 'required|string',
        ]);
        // Xử lý logic Check Out ở đây
        return response()->json([
            'success' => true,
            'message' => 'Checked Out successfully!',
        ]);
    }

    public function getCheckinoutManagerPage()
    {
        return view('page.checkinout.manager.index');
    }
}
