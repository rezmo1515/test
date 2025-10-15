<?php
namespace App\Domain\V1\User\Services;

use App\Services\BaseService;

class UserService extends BaseService
{
    public function hashPassword(string $password): string
    {
        return password_hash($password, PASSWORD_BCRYPT);
    }

    public function verifyPassword(string $password, string $hash): bool
    {
        return password_verify($password, $hash);
    }

}
