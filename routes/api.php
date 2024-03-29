<?php

use App\Http\Controllers\Api\v1\RegisterController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\User;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::GET('/registers', function () {
    return User::all();
});

Route::POST('/verify-otp', [RegisterController::class,'sendOtp'])->name('sendotp');
Route::GET('/verify-otp', [RegisterController::class,'otpVerify']);
Route::POST('/register', [RegisterController::class,'create'])->name('registeruser');


Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
