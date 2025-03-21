<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');




// ----AUTHENTICATION---- //
Route::prefix('auth')->controller(App\Http\Controllers\User\AuthController::class)->group(function () {
    Route::post('/register', 'register');
    Route::post('/login', 'login');
    Route::post('/employee', 'employee')->middleware('auth:sanctum');
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

// ----HOME---- //
Route::get('/main', [App\Http\Controllers\Main\HomeController::class, 'index'])->middleware('auth:sanctum');

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
    Route::get('/branch/{branch}', 'branch');
    Route::get('/{category}', 'show');
    Route::post('/', 'store');
    Route::put('/{category}', 'update');
    Route::delete('/{category}', 'destroy');
});

// ----PRODUCT---- //
Route::prefix('product')->controller(App\Http\Controllers\Main\ProductController::class)->middleware('auth:sanctum')->group(function () {
    Route::get('/', 'index');
    Route::get('/branch/{branch}', 'branch');
    Route::get('/{product}', 'show');
    Route::post('/', 'store');
    Route::post('/{product}', 'update');
    Route::delete('/{product}', 'destroy');
});

// ----TRANSACTION---- //
Route::prefix('transaction')->controller(App\Http\Controllers\Main\TransactionController::class)->middleware('auth:sanctum')->group(function () {
    Route::get('/', 'index');
    Route::get('/branch/{branch}', 'branch');
    Route::get('/{transaction}', 'show');
    Route::post('/', 'store');
    Route::put('/{transaction}', 'update');
    Route::delete('/{transaction}', 'destroy');
});

// ----------------------------------------------------------  MAIN  ---------------------------------------------------------- //




// ----------------------------------------------------------  EMPLOYEE  ---------------------------------------------------------- //

// ----ROLE---- //
Route::prefix('role')->controller(App\Http\Controllers\Employee\RoleController::class)->middleware('auth:sanctum')->group(function () {
    Route::get('/', 'index');
    Route::get('/{role}', 'show');
    Route::post('/', 'store');
    Route::put('/{role}', 'update');
    Route::delete('/{role}', 'destroy');
});

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
    Route::get('/profile', 'profile');
    Route::get('/{employee}', 'show');
    Route::post('/', 'store');
    Route::post('/{employee}', 'update');
    Route::delete('/{employee}', 'destroy');
});

// ----------------------------------------------------------  EMPLOYEE  ---------------------------------------------------------- //
