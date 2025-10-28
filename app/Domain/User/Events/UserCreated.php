<?php

namespace App\Domain\User\Events;

use App\Domain\User\Entities\User;

class UserCreated
{
    public function __construct(public User $user) {}
}
