<?php

namespace App\Domain\V1\User\Events;

use App\Domain\V1\User\Entities\User;

class UserRegistered
{
    public function __construct(public User $user) {}
}
