<?php

use App\Http\Controllers\web\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\Auth\LoginController;

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.submit');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

Route::middleware(['auth'])->group(function () {
Route::get('/', [UserController::class, 'index'])->name('home');
Route::get('/createuser', [UserController::class, 'create'])->name('createuser');
Route::post('/storeuser', [UserController::class, 'store'])->name('storeuser');
Route::get('/edituser/{user}', [UserController::class, 'edituser'])->name('edituser');
Route::put('/updateuser/{user}', [UserController::class, 'update'])->name('updateuser');
Route::delete('/deleteuser/{user}', [UserController::class, 'destroy'])->name('deleteuser');
});
