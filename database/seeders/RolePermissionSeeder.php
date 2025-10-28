<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;
use App\Models\Permission;
use App\Models\User;

class RolePermissionSeeder extends Seeder
{
    public function run()
    {
        $permissions = [
            'department:index',
            'department:create',
            'department:update',
            'department:delete',

            'employee:create',
            'employee:update',
            'employee:delete',
            'employee:index',

            'position:index',
            'position:create',
            'position:update',
            'position:delete',

            'role:index',
            'role:create',
            'role:update',
            'role:delete',

            'permission:index',
            'permission:create',
            'permission:update',
            'permission:delete',

        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        $adminRole = Role::firstOrCreate(['name' => 'Admin']);
        $managerRole = Role::firstOrCreate(['name' => 'Manager']);
        $employeeRole = Role::firstOrCreate(['name' => 'Employee']);

        $adminPermissions = Permission::all();
        $managerPermissions = Permission::whereIn('name', [
            'employee:create', 'employee:update', 'employee:index', 'position:index', 'position:create'
        ])->get();
        $employeePermissions = Permission::whereIn('name', [
            'employee:index', 'position:index'
        ])->get();

        $adminRole->permissions()->sync($adminPermissions);
        $managerRole->permissions()->sync($managerPermissions);
        $employeeRole->permissions()->sync($employeePermissions);

        $adminUser = User::where('email', 'mohammadreza@gmail.com')->first();
        if ($adminUser) {
            $adminUser->roles()->sync([$adminRole->id]);
        }

        $managerUser = User::where('email', 'mohammadreza_sffh@mobinhost.com')->first();
        if ($managerUser) {
            $managerUser->roles()->sync([$managerRole->id]);
        }

        $employeeUser = User::where('email', 'mohammadrezaaa@mobinhost.com')->first();
        if ($employeeUser) {
            $employeeUser->roles()->sync([$employeeRole->id]);
        }

        $this->command->info('Roles have been assigned to existing users!');
    }
}
