<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\v1\DoctorServiceController;
use App\Http\Controllers\Api\v1\InvoiceController;
use App\Http\Controllers\Api\v1\ProductController;

Route::apiResources([
    'services'=> DoctorServiceController::class,
    'invoices.products' => ProductController::class,
    'invoices'=> InvoiceController::class,
]);