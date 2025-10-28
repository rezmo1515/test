<?php

use App\Infrastructure\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::prefix('auth')->group(function () {
    Route::post('login',  [UserController::class, 'login']);
    Route::middleware('auth:sanctum')->post('logout', [UserController::class, 'logout']);
    Route::get('user/show',  [UserController::class, 'show']);
});
