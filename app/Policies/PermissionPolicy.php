<?php

namespace App\Policies;

use App\Models\User;

class PermissionPolicy
{
    /**
     * Determine if the user can assign permissions.
     */
    public function assignPermissions(User $user)
    {
        return $user->hasPermissionTo('permission:assign');
    }

    /**
     * Determine if the user can view any permission.
     */
    public function viewAny(User $user)
    {
        return $user->hasPermissionTo('permission:index');
    }

    /**
     * Determine if the user can view a specific permission.
     */
    public function view(User $user)
    {
        return $user->hasPermissionTo('permission:index');
    }
}
