<?php

use App\Infrastructure\Http\Controllers\PositionController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('positions', PositionController::class);
});
