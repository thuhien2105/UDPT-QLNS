<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ApprovalsController;
use App\Http\Controllers\RequestController;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::prefix('api')->group(function () {
    Route::get('employees', [EmployeeController::class, 'index']);
    Route::get('employees/{id}', [EmployeeController::class, 'show']);
    Route::post('employees', [EmployeeController::class, 'store']);
    Route::put('employees/{id}', [EmployeeController::class, 'update']);
    Route::delete('employees/{id}', [EmployeeController::class, 'destroy']);
});

Route::get('/',[PageController::class, 'getHomePage'])->name('trang-chu');
Route::get('/approvals',[ApprovalsController::class, 'getCategoryPage'])->name('approvals-category');
Route::get('/approvals/form',[ApprovalsController::class, 'getFormPage'])->name('approvals-form');
Route::get('/approvals/list',[ApprovalsController::class, 'getListPage'])->name('approvals-list');

Route::get('/employees/form',[EmployeeController::class, 'getFormPage'])->name('employees-form');
Route::get('/employees',[EmployeeController::class, 'getListPage'])->name('employees-list');


Route::get('/requests', [RequestController::class, 'index']);
Route::get('/requests/{id}', [RequestController::class, 'show']);
Route::post('/requests', [RequestController::class, 'store']);
Route::put('/requests/{id}', [RequestController::class, 'update']);
Route::delete('/requests/{id}', [RequestController::class, 'destroy']);

