<?php
namespace App\Infrastructure\Http\Controllers;

use App\Domain\RolesPermissions\Services\RolePermissionService;
use App\Infrastructure\Http\Requests\RolePermission\CreateRoleRequest;
use App\Infrastructure\Http\Requests\RolePermission\AssignPermissionsRequest;
use App\Infrastructure\Http\Requests\RolePermission\CreateRoleUserRequest;
use App\Infrastructure\Http\Requests\RolePermission\UpdateRoleUserRequest;
use App\Infrastructure\Http\Requests\RolePermission\ShowRoleRequest;
use App\Infrastructure\Http\Requests\RolePermission\UpdateRoleRequest;
use App\Models\Permission;
use App\Models\UserRole;
use Illuminate\Http\JsonResponse;
use App\Models\Role;
use Throwable;

class RolePermissionController extends ApiController
{
    protected RolePermissionService $rolePermissionService;

    public function __construct(RolePermissionService $rolePermissionService)
    {
        $this->rolePermissionService = $rolePermissionService;
    }

    /**
     * Display a listing of the roles.
     */
    public function index(ShowRoleRequest $request): JsonResponse
    {
        $this->authorize('viewAny', Role::class);
        try {
            return $this->success($this->rolePermissionService->showRoleAndPermission($request->only(['name'])));
        } catch (Throwable $e) {
            return $this->failure($e->getMessage() ?: 'Unable to fetch roles.');
        }
    }

    /**
     * Store a newly created role in storage.
     */
    public function store(CreateRoleRequest $request): JsonResponse
    {
        $this->authorize('create', Role::class);
        try {
            return $this->success($this->rolePermissionService->createRole($request->input('name'),$request->input('description'), $request->input('permissions')));
        } catch (Throwable $e) {
            return $this->failure($e->getMessage() ?: 'Unable to create role.');
        }
    }

    /**
     * Display the specified role.
     */
    public function show(): JsonResponse
    {
        $this->authorize('view', Role::class);
        try {
            return $this->success($this->rolePermissionService->showRole());
        } catch (Throwable $e) {
            return $this->failure($e->getMessage() ?: 'Unable to fetch role.');
        }
    }

    /**
     * Update the specified role in storage.
     */
    public function update(UpdateRoleRequest $request, Role $role): JsonResponse
    {
        $this->authorize('update', $role);
        try {
            return $this->success($this->rolePermissionService->update($request->validated(), $role));
        } catch (Throwable $e) {
            return $this->failure($e->getMessage() ?: 'Unable to update role.');
        }
    }

    /**
     * Remove the specified role from storage.
     */
    public function destroy(Role $role): JsonResponse
    {
        $this->authorize('delete', $role);
        try {
            return $this->success($this->rolePermissionService->delete($role));
        } catch (Throwable $e) {
            return $this->failure($e->getMessage() ?: 'Unable to delete role.');
        }
    }

    /**
     * Assign permissions to an existing role.
     */
    public function assignPermissions(AssignPermissionsRequest $request): JsonResponse
    {
        $this->authorize('assignPermissions', Permission::class);
        try {
            return $this->success($this->rolePermissionService->assignPermissionsToRole($request->input('role_id'), $request->input('permissions')));
        } catch (Throwable $e) {
            return $this->failure($e->getMessage() ?: 'Unable to assign permissions.');
        }
    }

    /**
     * Get all available permissions to show in the frontend.
     */
    public function permissions(): JsonResponse
    {
        $this->authorize('viewAny', Permission::class);
        try {
            return $this->success($this->rolePermissionService->showPermission());
        } catch (Throwable $e) {
            return $this->failure($e->getMessage() ?: 'Unable to fetch roles.');
        }
    }

    /*
     * Get all user have role
     */
    public function roleUsers(): JsonResponse
    {
        $this->authorize('viewRoleUser', Role::class);
        try {
            return $this->success($this->rolePermissionService->getRoleUsers());
        }catch (Throwable $e){
            return $this->failure($e->getMessage() ?: 'Unable to fetch roles.');
        }
    }

    /*
     * update role for user
     */
    public function updateRoleUser(UpdateRoleUserRequest $request, $id): JsonResponse
    {
        $this->authorize('viewRoleUser', Role::class);
        try {
            return $this->success($this->rolePermissionService->updateRoleUser($request->validated(), UserRole::find($id)));
        } catch (Throwable $e) {
            return $this->failure($e->getMessage() ?: 'Unable to update role user.');
        }
    }

    /*
     * assign role to user
     */
    public function assignRoleUser(CreateRoleUserRequest $request): JsonResponse
    {
        try {
            return $this->success($this->rolePermissionService->assignRoleToUser($request->validated()));
        }catch (Throwable $e){
            return $this->failure($e->getMessage() ?: 'Unable to assign role user.');
        }
    }
}

