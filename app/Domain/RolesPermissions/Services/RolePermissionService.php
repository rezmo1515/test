<?php
namespace App\Domain\RolesPermissions\Services;

use App\Models\Employee;
use App\Models\Role;
use App\Models\Permission;
use App\Models\User;
use App\Models\UserRole;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class RolePermissionService
{
    /**
     * Create a new role with specified permissions
     */
    public function createRole(string $name,string $description, array $permissions)
    {
        $role = Role::create(['name' => $name, 'description' => $description]);

        $permissionModels = Permission::whereIn('name', $permissions)->get();
        $role->permissions()->attach($permissionModels);

        return array($role);
    }

    /**
     * Assign permissions to an existing role
     */
    public function assignPermissionsToRole(int $roleId, array $permissions)
    {
        $role = Role::findOrFail($roleId);

        $permissionModels = Permission::whereIn('name', $permissions)->get();

        $role->permissions()->syncWithoutDetaching($permissionModels->pluck('id')->toArray());

        return array($role);
    }


    /**
     * Assign a role to a user
     */
    public function assignRoleToUser(array $data)
    {
        DB::beginTransaction();

        try {
            $employee = Employee::findOrFail($data['employee_id']);
            $user = User::findOrFail($employee->user_id);
            $role = Role::findOrFail($data['role_id']);

            $user->roles()->attach($role);

            DB::commit();

            $logPath = storage_path('logs/role_changes.log');

            $logContent = sprintf(
                "[%s] local.INFO: Role Assigned: user_id=%s | employee_id=%s | role_id=%s | role_name=%s\n",
                now()->format('Y-m-d H:i:s'),
                $user->id,
                $employee->id,
                $role->id,
                $role->name ?? 'N/A'
            );

            File::append($logPath, $logContent);

            return [$role];

        } catch (\Exception $e) {
            DB::rollBack();

            File::append(
                storage_path('logs/role_changes.log'),
                sprintf("[%s] local.ERROR: ERROR assigning role: %s\n", now()->format('Y-m-d H:i:s'), $e->getMessage())
            );

            return ['error' => 'Failed to assign role to user: ' . $e->getMessage()];
        }
    }


    public function showRoleAndPermission(array $filters): array
    {
        $query = Role::query();

        if (!empty($filters['name'])) {
            $query->where('name', 'like', '%' . $filters['name'] . '%');
        }

        $roles = $query->with('permissions')->get();

        return $roles->toArray();
    }

    public function showPermission(): array
    {
        $query = Permission::query()->get();
        return $query->toArray();
    }

    /**
     * Assign permissions to an existing role
     */
    public function update(array $data, Role $role)
    {
        if (isset($data['permissions']) && !empty($data['permissions'])) {
            $permissionModels = Permission::whereIn('name', $data['permissions'])->get();

            $role->permissions()->sync($permissionModels->pluck('id')->toArray());
        } else {
            $role->permissions()->detach();
        }

        if (isset($data['name'])) {
            $role->name = $data['name'];
        }

        if (isset($data['description'])) {
            $role->description = $data['description'];
        }

        $role->update($data);

        return array($role);
    }


    public function delete(Role $role)
    {
        DB::beginTransaction();

        try {
            $role->permissions()->detach();

            $role->delete();

            DB::commit();

            return ['message' => 'Role deleted successfully.'];

        } catch (\Exception $e) {
            DB::rollBack();

            return ['error' => 'Failed to delete the role: ' . $e->getMessage()];
        }
    }

    public function showRole()
    {
        $query = Role::query()->get();
        return $query->toArray();
    }

    public function getRoleUsers()
    {
        $query = UserRole::query();
        $query->join('users', 'role_user.user_id', '=', 'users.id');
        $query->join('roles', 'roles.id', '=', 'role_user.role_id');
        $query->select('role_user.id', 'users.username', 'roles.name', 'role_user.created_at', 'role_user.updated_at');
        return $query->get()->toArray();
    }

    public function updateRoleUser(array $data, UserRole $userRole)
    {
        DB::beginTransaction();

        try {
            $oldRoleId = $userRole->role_id;

            $userRole->role_id = $data['role_id'];
            $userRole->save();

            DB::commit();

            $logPath = storage_path('logs/role_changes.log');

            $logContent = sprintf(
                "[%s] local.INFO: UserRole Updated: user_id=%s | old_role_id=%s | new_role_id=%s\n",
                now()->format('Y-m-d H:i:s'),
                $userRole->user_id ?? 'unknown',
                $oldRoleId,
                $data['role_id']
            );

            File::append($logPath, $logContent);

            return [$userRole];

        } catch (\Exception $e) {
            DB::rollBack();

            File::append(
                storage_path('logs/role_changes.log'),
                sprintf("[%s] local.ERROR: ERROR updating role user: %s\n", now()->format('Y-m-d H:i:s'), $e->getMessage())
            );

            return ['error' => 'Failed to update the role user: ' . $e->getMessage()];
        }
    }
}
