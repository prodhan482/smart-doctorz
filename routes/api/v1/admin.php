<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\v1\TenantController;
use App\Http\Controllers\Api\v1\ServiceController;


Route::apiResource('tenants', TenantController::class);
Route::apiResource('services', ServiceController::class);
