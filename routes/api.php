<?php

use Illuminate\Support\Facades\Route;

// Group with version prefix + middleware
Route::prefix('v1')->group(function () {
    // Autoload routes in routes/api/v1/*.php
    foreach (glob(__DIR__.'/api/v1/*.php') as $file) {
        require $file;
    }
});
