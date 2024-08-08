<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Request as HttpRequest;

class RequestController extends Controller
{
    public function index()
    {
        return Request::with(['employee', 'manager'])->get();
    }

    public function show($id)
    {
        return Request::with(['employee', 'manager'])->findOrFail($id);
    }

    public function store(HttpRequest $request)
    {
        $request->validate([
            'employee_id' => 'required|exists:employees,employee_id',
            'request_type' => 'required|in:leave,update_time_sheet,check_in,check_out,wfh',
            'request_date' => 'required|date',
            'manager_id' => 'required|exists:employees,employee_id',
        ]);

        return Request::create($request->all());
    }

    public function update(HttpRequest $request, $id)
    {
        $request = Request::findOrFail($id);
        $request->update($request->all());
        return $request;
    }

    public function destroy($id)
    {
        Request::destroy($id);
        return response()->noContent();
    }
}