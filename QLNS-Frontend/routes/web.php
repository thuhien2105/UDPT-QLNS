<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\GiftsController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ApprovalsController;
use App\Http\Controllers\RequestController;
use App\Http\Controllers\CampaignController;
use App\Http\Controllers\NotificationController;

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::prefix('api')->group(function () {
//     Route::get('employees', [EmployeeController::class, 'index']);
//     Route::get('employees/{id}', [EmployeeController::class, 'show']);
//     Route::post('employees', [EmployeeController::class, 'store']);
//     Route::put('employees/{id}', [EmployeeController::class, 'update']);
//     Route::delete('employees/{id}', [EmployeeController::class, 'destroy']);
// });

Route::middleware('checkRole:manager')->group(function () {
    Route::get('/employees/add',[EmployeeController::class, 'getCreatePage'])->name('employees-add');
    Route::get('/employees/form',[EmployeeController::class, 'getFormPage'])->name('employees-form');
    Route::get('/employees',[EmployeeController::class, 'getListPage'])->name('employees-list');

    Route::get('/gifts/form',[GiftsController::class, 'getFormPage'])->name('gifts-form');
    Route::get('/gifts',[GiftsController::class, 'getListPage'])->name('gifts-list');

    Route::get('/campaign/add',[CampaignController::class, 'getCreatePage'])->name('campaign-add');
    Route::post('/campaign/add',[CampaignController::class, 'createCampaign'])->name('campaign-add');
});

Route::post('/employees/add',[EmployeeController::class, 'createEmployee'])->name('employees-create');
Route::put('/employees/edit',[EmployeeController::class, 'editEmployee'])->name('employees-edit');
Route::get('/approvals',[ApprovalsController::class, 'getCategoryPage'])->name('approvals-category');
Route::get('/approvals/form',[ApprovalsController::class, 'getFormPage'])->name('approvals-form');
Route::get('/approvals/list',[ApprovalsController::class, 'getListPage'])->name('approvals-list');
Route::get('/check-in-out',[EmployeeController::class, 'getCheckinoutPage'])->name('check-in-out');
Route::get('/check-in-out/manager',[EmployeeController::class, 'getCheckinoutManagerPage'])->name('check-in-out-manager');
Route::post('/check-in', [EmployeeController::class, 'checkIn'])->name('check.in');
Route::post('/check-out', [EmployeeController::class, 'checkOut'])->name('check.out');
Route::get('/user',[UserController::class, 'getFormPage'])->name('user-form');
Route::get('/campaign/form',[CampaignController::class, 'getFormPage'])->name('campaign-form');
Route::get('/campaign',[CampaignController::class, 'getListPage'])->name('campaign-list');

// Routes không cần role middleware
Route::get('/',[PageController::class, 'getHomePage'])->name('trang-chu');
Route::get('/login',[PageController::class, 'getLoginPage'])->name('login');
Route::get('/signup',[PageController::class, 'getSignupPage'])->name('signup');
Route::post('/login',[PageController::class, 'checkLogin'])->name('login.check');
Route::post('/signup',[PageController::class, 'checkSignup'])->name('signup.check');

Route::get('/requests', [RequestController::class, 'index']);
Route::get('/requests/{id}', [RequestController::class, 'show']);
Route::post('/requests', [RequestController::class, 'store']);
Route::put('/requests/{id}', [RequestController::class, 'update']);
Route::delete('/requests/{id}', [RequestController::class, 'destroy']);

Route::post('/clear-notifications', [NotificationController::class, 'clearNotifications']);
