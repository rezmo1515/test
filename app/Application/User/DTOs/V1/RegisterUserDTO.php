<?php

namespace App\Application\User\DTOs\V1;

class RegisterUserDTO
{
    public function __construct(
        public string $username,
        public string $email,
        public string $password,
    ) {}
}
