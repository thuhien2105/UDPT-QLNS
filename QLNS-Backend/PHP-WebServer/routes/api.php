<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\RequestController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ActivityController;

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
Route::post('signout', [AuthController::class, 'logout']);



Route::get('employees/getAll/{keyword}/{page}', [EmployeeController::class, 'index']);
Route::get('employees/{employee_id}', [EmployeeController::class, 'show']);
Route::post('employees', [EmployeeController::class, 'store']);
Route::put('employees/{employee_id}', [EmployeeController::class, 'update']);
Route::put('employees/changePassword/{employee_id}', [EmployeeController::class, 'changePassword']);
Route::delete('employees/{employee_id}', [EmployeeController::class, 'destroy']);


Route::get('requests/{page}/{month}/{year}', [RequestController::class, 'index']);
Route::get('requests/timesheet/{page}/{month}/{year}', [RequestController::class, 'indexTimeSheet']);


Route::get('request/{employeeId}/{page}/{month}/{year}', [RequestController::class, 'showRequestByEmployee']);
Route::get('request/timesheet/{employeeId}/{page}/{month}/{year}', [RequestController::class, 'showTimeSheetByEmployee']);


Route::get('request/{id}', [RequestController::class, 'showById']);
Route::post('request/timesheet/checkin', [RequestController::class, 'checkin']);
Route::post('request/timesheet/checkout', [RequestController::class, 'checkout']);
Route::post('request/approve/{id}', [RequestController::class, 'approve']);
Route::post('request/create', [RequestController::class, 'store']);
Route::put('request/{id}', [RequestController::class, 'update']);
Route::delete('request/{id}', [RequestController::class, 'destroy']);

Route::get('/activities', [ActivityController::class, 'getActivities']);
Route::post('/activities', [ActivityController::class, 'postActivities']);
Route::put('/activities/{id}', [ActivityController::class, 'updateActivity']);
Route::get('/activities/{id}', [ActivityController::class, 'getActivity']);

Route::get('/authorize', [ActivityController::class, 'activity_authorize']);
Route::get('/callback', [ActivityController::class, 'activity_callback']);
Route::post('/refresh_token', [ActivityController::class, 'activity_refreshToken']);
