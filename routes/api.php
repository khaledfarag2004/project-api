<?php

use App\Http\Controllers\Auth\Register\RegisterController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\Login\LoginController;
use App\Http\Controllers\Profile\ProfileController;



Route::prefix('auth')->group(function () {
    Route::post('register', [RegisterController::class, 'register']);
    Route::post('otp-register', [RegisterController::class, 'otpRegister']);
    Route::post('login', [LoginController::class, 'login']);
    Route::post('ForgotPassword', [LoginController::class, 'forgotPassword']);
    Route::middleware('auth:sanctum')->get('logout', [LoginController::class, 'logout']);

    Route::middleware('auth:sanctum')->post('resetpassword', [LoginController::class, 'resetpassword']);});
Route::middleware('auth:sanctum')->prefix('profile')->group(function () {
    Route::put('edit', [ProfileController::class, 'editProfile']);
    Route::get('show', [ProfileController::class, 'show']);
});
