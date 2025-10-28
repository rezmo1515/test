<?php

namespace App\Domain\User\Repositories;

use App\Domain\User\Entities\User;

interface UserRepositoryInterface
{
    public function findById(int $id): ?User;
    public function save(User $user): ?int;
    public function findByUsername(string $username): ?User;
    public function findByEmail(string $email): ?User;
    public function delete(User $user): bool;
}
