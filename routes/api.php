<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
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
Route::prefix('user')->controller(App\Http\Controllers\User\UserController::class)->group(function () {
    Route::get('/', 'index');
    Route::get('/{user}', 'show');
    Route::post('/', 'store')->middleware('auth:sanctum');
    Route::post('/{user}', 'update')->middleware('auth:sanctum');
    Route::delete('/{user}', 'destroy')->middleware('auth:sanctum');
});

// ----SETTING---- //
Route::prefix('setting')->controller(App\Http\Controllers\SettingController::class)->group(function () {
    Route::get('/', 'index');
    Route::get('/{setting}', 'show');
    Route::post('/', 'store')->middleware('auth:sanctum');
    Route::post('/{setting}', 'update')->middleware('auth:sanctum');
    Route::delete('/{setting}', 'destroy')->middleware('auth:sanctum');
});
