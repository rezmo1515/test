<?php

namespace App\Domain\V1\User\Entities;

use App\Domain\V1\User\ValueObjects\Email;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Laravel\Sanctum\HasApiTokens;

class User
{
    use HasApiTokens, HasFactory;
    private int $id;
    private string $username;
    private bool $active;
    private Email $email;
    private string $passwordHash;
    private string $lastLogin;

    public function __construct(string $username, Email $email, string $passwordHash, bool $active, string $lastLogin)
    {
        $this->username = $username;
        $this->email = $email;
        $this->passwordHash = $passwordHash;
        $this->active = $active;
        $this->lastLogin = $lastLogin;
    }

    public function getUserName(): string
    {
        return $this->username;
    }

    public function getEmail(): Email
    {
        return $this->email;
    }

    public function getPasswordHash(): string
    {
        return $this->passwordHash;
    }

    public function isActive(): bool
    {
        return $this->active;
    }

    public function getLastLogin(): string
    {
        return $this->lastLogin ?? Carbon::now()->timestamp;
    }
}
