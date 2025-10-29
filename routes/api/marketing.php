<?php

use App\Infrastructure\Http\Controllers\FeatureMatrixController;
use Illuminate\Support\Facades\Route;

Route::get('feature-matrix', FeatureMatrixController::class);
