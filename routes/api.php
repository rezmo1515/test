<?php

use Illuminate\Support\Facades\Route;

// Group with version prefix + middleware
Route::group([], function () {
    // Autoload routes from all files in the api folder
    foreach (glob(__DIR__.'/api/*.php') as $file) {
        require $file;
    }
});
