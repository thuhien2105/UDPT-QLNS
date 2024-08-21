<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ApprovalsController;
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


// Route::get('/',[PageController::class, 'getHomePage'])->name('trang-chu');
// Route::get('/approvals',[ApprovalsController::class, 'getCategoryPage'])->name('approvals-category');
// Route::get('/approvals/form',[ApprovalsController::class, 'getFormPage'])->name('approvals-form');
// Route::get('/approvals/list',[ApprovalsController::class, 'getListPage'])->name('approvals-list');

// // Route::get('/employees/form',[EmployeeController::class, 'getFormPage'])->name('employees-form');
// // Route::get('/employees',[EmployeeController::class, 'getListPage'])->name('employees-list');


// Route::get('/requests', [RequestController::class, 'index']);
// Route::get('/requests/{id}', [RequestController::class, 'show']);
// Route::post('/requests', [RequestController::class, 'store']);
// Route::put('/requests/{id}', [RequestController::class, 'update']);
// Route::delete('/requests/{id}', [RequestController::class, 'destroy']);