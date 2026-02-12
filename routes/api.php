<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Category\CategoryController;
use Illuminate\Support\Facades\Route;


Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::middleware("auth:sanctum")->group(function() {
    Route::controller(AuthController::class)->group(function() {
        Route::post('/refresh', 'refresh');
        Route::post('/logout', 'logout');
        Route::get('/me', 'me');
    });
});

Route::get('categories', [CategoryController::class, 'index']);

Route::middleware('auth:sanctum')->group(function() {
    Route::controller(CategoryController::class)->group(function() {
        Route::post('/categories/create', 'store');
    });
});
