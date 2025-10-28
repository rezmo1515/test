<?php

namespace App\Policies;

use App\Models\User;

class LogViewerPolicy
{

    public function show(User $user): bool
    {
        return $user->hasPermissionTo('log:show');
    }
}
