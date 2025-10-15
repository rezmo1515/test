<?php

namespace App\Database\Eloquent;

use App\Domain\V1\User\Entities\User;
use App\Domain\V1\User\Repositories\UserRepositoryInterface;
use App\Domain\V1\User\ValueObjects\Email;

class EloquentUserRepository implements UserRepositoryInterface
{
    public function save(User $user): void
    {
        User::create([
            'username' => $user->getUserName(),
            'email' => (string) $user->getEmail(),
            'password' => $user->getPasswordHash(),
            'active' => (bool) $user->isActive(),
            'las_login' => $user->getLastLogin()
        ]);
    }

}
