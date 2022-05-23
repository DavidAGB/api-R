<?php

use App\Http\Controllers\AuthControlle;
use App\Http\Controllers\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});



Route::controller(ProductController::class)->group(function () {
    // Route::get('products', [ProductController::class, 'index']);
    Route::get('products', 'index');

    Route::get('product/{product}', 'show');

    Route::post('product', 'store');

    Route::put('product/{product}', 'update');

    Route::delete('product/{product}', 'destroy');
});

Route::post('login', [AuthControlle::class, 'login']);

Route::post('register', [AuthControlle::class, 'register']);

Route::middleware(['auth:sanctum'])->group(function () {

    Route::get('logout', [AuthControlle::class, 'logout']);
});
