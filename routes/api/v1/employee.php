<?php

use App\Infrastructure\Http\Controllers\V1\EmployeeController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->group(function () {
    Route::post('employees', [EmployeeController::class, 'store']);
});
