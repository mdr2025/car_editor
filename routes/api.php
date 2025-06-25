<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\CarController;
use App\Http\Controllers\API\CarEngineController;
use App\Http\Controllers\API\CarInventoryController;
use App\Http\Controllers\API\CustomerController;
use App\Http\Controllers\API\CustomerBankAccountController;
use App\Http\Controllers\API\EmployeeController;
use App\Http\Controllers\API\JobController;
use App\Http\Controllers\API\SaleController;
use App\Http\Controllers\API\ShowroomController;
use App\Http\Controllers\API\UserController;
use App\Http\Controllers\API\VisitController;
use App\Http\Controllers\API\ShowroomStockController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| هنا يمكنك تسجيل مسارات API لتطبيقك. تقوم هذه المسارات بتحميل
| RouteServiceProvider ضمن مجموعة تحتوي على وسيط "api".
|
*/

// مسارات المصادقة
Route::group(['prefix' => 'auth'], function () {
    Route::post('register', [AuthController::class, 'register']);
    Route::post('login', [AuthController::class, 'login']);

    Route::group(['middleware' => 'auth:api'], function () {
        Route::post('logout', [AuthController::class, 'logout']);
        Route::post('refresh', [AuthController::class, 'refresh']);
        Route::get('me', [AuthController::class, 'me']);
    });
});

// مسارات المستخدمين
Route::apiResource('users', UserController::class);

// مسارات المعارض
Route::apiResource('showrooms', ShowroomController::class);

// مسارات السيارات
Route::apiResource('cars', CarController::class);

// مسارات محركات السيارات
Route::apiResource('car-engines', CarEngineController::class);

// مسارات مخزون السيارات
Route::apiResource('car-inventories', CarInventoryController::class);

// مسارات العملاء
Route::apiResource('customers', CustomerController::class);

// مسارات الحسابات البنكية للعملاء
Route::apiResource('customer-bank-accounts', CustomerBankAccountController::class);

// مسارات الموظفين
Route::apiResource('employees', EmployeeController::class);

// مسارات الوظائف
Route::apiResource('jobs', JobController::class);

// مسارات الزيارات
Route::apiResource('visits', VisitController::class);

// مسارات المبيعات
Route::apiResource('sales', SaleController::class);

// مسارات مخزون المعارض

// //تم التعديل هنا
// Route::apiResource('showroom-stocks', ShowroomStockController::class);
