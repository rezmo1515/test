<?php

namespace App\Policies;

namespace App\Policies;

use App\Models\User;

class RolePolicy
{
    /**
     * Determine if the user can create a role.
     */
    public function create(User $user)
    {
        return $user->hasPermissionTo('role:create');
    }

    /**
     * Determine if the user can update a role.
     */
    public function update(User $user)
    {
        return $user->hasPermissionTo('role:update');
    }

    /**
     * Determine if the user can delete a role.
     */
    public function delete(User $user)
    {
        return $user->hasPermissionTo('role:delete');
    }

    /**
     * Determine if the user can view any role.
     */
    public function viewAny(User $user)
    {
        return $user->hasPermissionTo('role:index');
    }

    /**
     * Determine if the user can view a specific role.
     */
    public function view(User $user)
    {
        return $user->hasPermissionTo('role:index');
    }

    public function viewRoleUser(User $user)
    {
        return $user->hasPermissionTo('role:index');
    }
}

