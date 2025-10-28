<?php

use App\Infrastructure\Http\Controllers\RollCallController;
use Illuminate\Support\Facades\Route;

Route::prefix('roll-call')->middleware('auth:sanctum')->group(function () {

    Route::get('/device1', [RollCallController::class, 'showDevice1'])->name('rollcall.device1');
    Route::get('/device2', [RollCallController::class, 'showDevice2'])->name('rollcall.device2');
    Route::get('/device3', [RollCallController::class, 'showDevice3'])->name('rollcall.device3');

    Route::get('/', [RollCallController::class, 'showEntries'])->name('rollcall.index');

    Route::post('/entry', [RollCallController::class, 'createEntry'])->name('rollcall.store');

    Route::put('/entry/{rollCall}', [RollCallController::class, 'updateEntry'])->name('rollcall.update');
    Route::patch('/entry/{rollCall}', [RollCallController::class, 'updateEntry']); // optional patch

    Route::delete('/entry/{rollCall}', [RollCallController::class, 'deleteEntry'])->name('rollcall.delete');
});
