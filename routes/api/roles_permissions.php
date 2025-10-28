<?php
use App\Infrastructure\Http\Controllers\RolePermissionController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->group(function () {
    Route::prefix('roles-permissions')->group(function () {
        Route::apiResource('roles', RolePermissionController::class);
        Route::post('roles/assign-permissions', [RolePermissionController::class, 'assignPermissions']);
        Route::get('permissions', [RolePermissionController::class, 'permissions']);
        Route::get('roles/show', [RolePermissionController::class, 'show']);
        Route::get('role-user', [RolePermissionController::class, 'roleUsers']);
        Route::put('role-user/{id}', [RolePermissionController::class, 'updateRoleUser']);
        Route::post('role-user', [RolePermissionController::class, 'assignRoleUser']);
    });
});
