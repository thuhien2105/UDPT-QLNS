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


Route::get('employees/{keyword}/{page}', [EmployeeController::class, 'index']);

Route::get('employees/{id}', [EmployeeController::class, 'show']);
Route::post('employees', [EmployeeController::class, 'store']);
Route::put('employees/{id}', [EmployeeController::class, 'update']);
Route::delete('employees/{id}', [EmployeeController::class, 'destroy']);



Route::get('request', [RequestController::class, 'index']);
Route::get('request/{employeeId}', [RequestController::class, 'show']);
Route::post('request', [RequestController::class, 'store']);
Route::put('request/{id}', [RequestController::class, 'update']);
Route::delete('request/{id}', [RequestController::class, 'destroy']);
