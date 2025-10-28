<?php

namespace App\Policies;

use App\Models\Employee;
use App\Models\User;

class EmployeePolicy
{
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('employee:create');
    }

    public function update(User $user): bool
    {
        return $user->hasPermissionTo('employee:update');
    }

    public function delete(User $user): bool
    {
        return $user->hasPermissionTo('employee:delete');
    }

    public function index(User $user): bool
    {
        return $user->hasPermissionTo('employee:index');
    }
}
