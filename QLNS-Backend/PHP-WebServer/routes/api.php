<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\RequestController;
use App\Http\Controllers\AuthController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('signin', [AuthController::class, 'signin']);
Route::post('signout', [AuthController::class, 'signout']);


Route::middleware('jwt.auth')->group(function () {

    Route::get('employees/{keyword}/{page}', [EmployeeController::class, 'index']);
    Route::get('employees/{employee_id}', [EmployeeController::class, 'show']);
    Route::post('employees', [EmployeeController::class, 'store']);
    Route::put('employees/{employee_id}', [EmployeeController::class, 'update']);
    Route::put('employees/changePassword/{employee_id}', [EmployeeController::class, 'changePassword']);
    Route::delete('employees/{employee_id}', [EmployeeController::class, 'destroy']);

    Route::get('request/{page}', [RequestController::class, 'index']);
    Route::get('request/{employeeId}/{page}/{month}/{year}', [RequestController::class, 'showRequestByEmployee']);
    Route::get('request/timesheet/{employeeId}/{page}/{month}/{year}', [RequestController::class, 'showTimeSheetByEmployee']);
    Route::get('request/{id}', [RequestController::class, 'showById']);
    Route::post('request/checkin', [RequestController::class, 'checkin']);
    Route::post('request/checkout', [RequestController::class, 'checkout']);
    Route::post('request/approve/{id}', [RequestController::class, 'approve']);
    Route::post('request/create', [RequestController::class, 'store']);
    Route::put('request/{id}', [RequestController::class, 'update']);
    Route::delete('request/{id}', [RequestController::class, 'destroy']);
});
