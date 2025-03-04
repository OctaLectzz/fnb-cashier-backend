<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|------------------------------------------------------------------------------------
| API Routes
|------------------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});




// ----AUTHENTICATION---- //
Route::prefix('auth')->controller(App\Http\Controllers\User\AuthController::class)->group(function () {
    Route::post('/register', 'register');
    Route::post('/login', 'login');
    Route::get('/logout', 'logout')->middleware('auth:sanctum');
});

// ----PROFILE---- //
Route::prefix('profile')->controller(App\Http\Controllers\User\ProfileController::class)->middleware('auth:sanctum')->group(function () {
    Route::get('/', 'profile');
    Route::post('/', 'editprofile');
    Route::post('/change-password', 'changepassword');
});

// ----USER---- //
Route::prefix('user')->controller(App\Http\Controllers\User\UserController::class)->middleware('auth:sanctum')->group(function () {
    Route::get('/', 'index');
    Route::get('/{user}', 'show');
    Route::post('/', 'store');
    Route::post('/{user}', 'update');
    Route::delete('/{user}', 'destroy');
});

// ----SETTING---- //
Route::prefix('setting')->controller(App\Http\Controllers\SettingController::class)->group(function () {
    Route::get('/', 'index');
    Route::get('/{setting}', 'show');
    Route::post('/', 'store')->middleware('auth:sanctum');
    Route::post('/{setting}', 'update')->middleware('auth:sanctum');
    Route::delete('/{setting}', 'destroy')->middleware('auth:sanctum');
});





// ----------------------------------------------------------  MAIN  ---------------------------------------------------------- //

// ----BRANCH---- //
Route::prefix('branch')->controller(App\Http\Controllers\Main\BranchController::class)->middleware('auth:sanctum')->group(function () {
    Route::get('/', 'index');
    Route::get('/{branch}', 'show');
    Route::post('/', 'store');
    Route::post('/{branch}', 'update');
    Route::delete('/{branch}', 'destroy');
});

// ----CATEGORY---- //
Route::prefix('category')->controller(App\Http\Controllers\Main\CategoryController::class)->middleware('auth:sanctum')->group(function () {
    Route::get('/', 'index');
    Route::get('/{category}', 'show');
    Route::post('/', 'store');
    Route::put('/{category}', 'update');
    Route::delete('/{category}', 'destroy');
});

// ----PRODUCT---- //
Route::prefix('product')->controller(App\Http\Controllers\Main\ProductController::class)->middleware('auth:sanctum')->group(function () {
    Route::get('/', 'index');
    Route::get('/{product}', 'show');
    Route::post('/', 'store');
    Route::post('/{product}', 'update');
    Route::delete('/{product}', 'destroy');
});

// ----TRANSACTION---- //
Route::prefix('transaction')->controller(App\Http\Controllers\Main\TransactionController::class)->middleware('auth:sanctum')->group(function () {
    Route::get('/', 'index');
    Route::get('/{transaction}', 'show');
    Route::post('/', 'store');
    Route::put('/{transaction}', 'update');
    Route::delete('/{transaction}', 'destroy');
});

// ----------------------------------------------------------  MAIN  ---------------------------------------------------------- //




// ----------------------------------------------------------  EMPLOYEE  ---------------------------------------------------------- //

// ----SCHEDULE---- //
Route::prefix('schedule')->controller(App\Http\Controllers\Employee\ScheduleController::class)->middleware('auth:sanctum')->group(function () {
    Route::get('/', 'index');
    Route::get('/{schedule}', 'show');
    Route::post('/', 'store');
    Route::put('/{schedule}', 'update');
    Route::delete('/{schedule}', 'destroy');
});

// ----EMPLOYEE---- //
Route::prefix('employee')->controller(App\Http\Controllers\Employee\EmployeeController::class)->middleware('auth:sanctum')->group(function () {
    Route::get('/', 'index');
    Route::get('/{employee}', 'show');
    Route::post('/', 'store');
    Route::post('/{employee}', 'update');
    Route::delete('/{employee}', 'destroy');
});

// ----------------------------------------------------------  EMPLOYEE  ---------------------------------------------------------- //
