<?php

use App\Http\Controllers\Auth\RegisterController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::POST('/otpSend', [RegisterController::class, 'sendOtp'])
    ->middleware('guest')
    ->name('otpSend');
