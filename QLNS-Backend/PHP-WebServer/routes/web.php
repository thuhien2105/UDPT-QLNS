<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\RequestController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Route::prefix('api')->group(function () {
    Route::post('signin', [EmployeeController::class, 'signin']);


    Route::get('employees', [EmployeeController::class, 'index']);
    Route::get('employees/{id}', [EmployeeController::class, 'show']);
    Route::post('employees', [EmployeeController::class, 'store']);
    Route::put('employees/{id}', [EmployeeController::class, 'update']);
    Route::delete('employees/{id}', [EmployeeController::class, 'destroy']);


    Route::get('request', [RequestController::class, 'index']);
    Route::get('request/{employeeId}', [RequestController::class, 'show']);

    Route::get('request/{id}', [RequestController::class, 'show']);
    Route::post('request', [RequestController::class, 'store']);
    Route::put('request/{id}', [RequestController::class, 'update']);
    Route::delete('request/{id}', [RequestController::class, 'destroy']);
});
