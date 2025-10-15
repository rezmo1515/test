<?php

namespace App\Domain\V1\User\Repositories;

use App\Domain\V1\User\Entities\User;

interface UserRepositoryInterface
{
    public function save(User $user);
}
