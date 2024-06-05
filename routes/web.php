<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PointingController;
use App\Http\Controllers\QrScanController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\OvertimeController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\RemunerationController;
use App\Http\Controllers\SalaryController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\PermissionController;


Route::get('/', function () {
    return view('welcome');
});

// Routes pour Employee
Route::get('/employees', [EmployeeController::class, 'index']);
Route::post('/employees', [EmployeeController::class, 'store']);
Route::get('/employees/{id}', [EmployeeController::class, 'show']);
Route::put('/employees/{id}', [EmployeeController::class, 'update']);
Route::delete('/employees/{id}', [EmployeeController::class, 'destroy']);
Route::patch('/employees/{id}/status', [EmployeeController::class, 'changeStatus']);

// Routes pour Overtime
Route::get('/overtimes', [OvertimeController::class, 'index']);
Route::post('/overtimes', [OvertimeController::class, 'store']);
Route::get('/overtimes/{id}', [OvertimeController::class, 'show']);
Route::put('/overtimes/{id}', [OvertimeController::class, 'update']);
Route::delete('/overtimes/{id}', [OvertimeController::class, 'destroy']);

// Routes pour Payment
Route::get('/payments', [PaymentController::class, 'index']);
Route::post('/payments', [PaymentController::class, 'store']);
Route::get('/payments/{id}', [PaymentController::class, 'show']);
Route::put('/payments/{id}', [PaymentController::class, 'update']);
Route::delete('/payments/{id}', [PaymentController::class, 'destroy']);
Route::get('/generate-payments', [PaymentController::class, 'generatePayments']);

// Routes pour Remuneration
Route::get('/remunerations', [RemunerationController::class, 'index']);
Route::post('/remunerations', [RemunerationController::class, 'store']);
Route::get('/remunerations/{id}', [RemunerationController::class, 'show']);
Route::put('/remunerations/{id}', [RemunerationController::class, 'update']);
Route::delete('/remunerations/{id}', [RemunerationController::class, 'destroy']);

// Routes pour Salary
Route::get('/salaries', [SalaryController::class, 'index']);
Route::post('/salaries', [SalaryController::class, 'store']);
Route::get('/salaries/{id}', [SalaryController::class, 'show']);
Route::put('/salaries/{id}', [SalaryController::class, 'update']);
Route::delete('/salaries/{id}', [SalaryController::class, 'destroy']);

// Routes pour Department
Route::get('/departments', [DepartmentController::class, 'index']);
Route::post('/departments', [DepartmentController::class, 'store']);
Route::get('/departments/{id}', [DepartmentController::class, 'show']);
Route::put('/departments/{id}', [DepartmentController::class, 'update']);
Route::delete('/departments/{id}', [DepartmentController::class, 'destroy']);

// Routes pour Post
Route::get('/posts', [PostController::class, 'index']);
Route::post('/posts', [PostController::class, 'store']);
Route::get('/posts/{id}', [PostController::class, 'show']);
Route::put('/posts/{id}', [PostController::class, 'update']);
Route::delete('/posts/{id}', [PostController::class, 'destroy']);
Route::post('/posts/{id}/permissions', [PostController::class, 'assignPermissions']);

// Routes pour Permission
Route::get('/permissions', [PermissionController::class, 'index']);
Route::post('/permissions', [PermissionController::class, 'store']);
Route::get('/permissions/{id}', [PermissionController::class, 'show']);
Route::put('/permissions/{id}', [PermissionController::class, 'update']);
Route::delete('/permissions/{id}', [PermissionController::class, 'destroy']);

Route::post('/scan', [QrScanController::class, 'scan']);

Route::get('/employees/{employeeId}/pointings/hours', [PointingController::class, 'getMonthlyPointingHours']);



Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
