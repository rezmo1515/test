<?php

use Illuminate\Support\Facades\Route;
use App\Infrastructure\Http\Controllers\V1\UserController;

Route::prefix('auth')->group(function () {
    Route::post('login',  [UserController::class, 'login']);
    Route::middleware('auth:sanctum')->post('logout', [UserController::class, 'logout']);
});
