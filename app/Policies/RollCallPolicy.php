<?php

namespace App\Policies;

use App\Models\User;
use App\Models\RollCall;

class RollCallPolicy
{
    /**
     * Determine if the user can create a roll call.
     */
    public function create(User $user)
    {
        return $user->hasPermissionTo('roll-call:create');
    }

    /**
     * Determine if the user can update a roll call.
     */
    public function update(User $user, RollCall $rollCall)
    {
        return $user->hasPermissionTo('roll-call:update');
    }

    /**
     * Determine if the user can delete a roll call.
     */
    public function delete(User $user, RollCall $rollCall)
    {
        return $user->hasPermissionTo('roll-call:delete');
    }

    /**
     * Determine if the user can view any roll calls.
     */
    public function showDevice(User $user)
    {
        return $user->hasPermissionTo('roll-call:show-device');
    }

    /**
     * Determine if the user can view a specific roll call.
     */
    public function index(User $user)
    {
        return $user->hasPermissionTo('roll-call:index');
    }
}
