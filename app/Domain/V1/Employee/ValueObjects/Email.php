<?php

namespace App\Domain\V1\Employee\ValueObjects;

class Email
{
    public function __construct(private string $email)
    {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new \InvalidArgumentException("Invalid email address.");
        }
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function __toString(): string
    {
        return $this->email;
    }
}
