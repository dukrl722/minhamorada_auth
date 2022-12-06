<?php

use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\EmailController;
use App\Http\Controllers\AddressController;
use App\Http\Controllers\PasswordController;
use App\Mail\RecoverMail;

// User
Route::post('/login', [UsersController::class, 'authenticateUser']);
Route::post('/newUser', [UsersController::class, 'addUser']);

// Password
Route::post('/recover', [PasswordController::class, 'recoverMail']);
Route::post('/password/reset', [PasswordController::class, 'resetPassword']);
Route::get('/password/reset/{token}', [PasswordController::class, 'returnTokenReset'])->name('password.reset');

// Address
Route::get('/cep', [AddressController::class, 'dataCEP']);

// Sanctum auth
Route::group(['middleware' => ['auth:sanctum']], function() {
    Route::post('/logout', [UsersController::class, 'endSession']);
    Route::get('/users', [UsersController::class, 'listAllUsers']);
});
