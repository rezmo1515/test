<?php

namespace App\Domain\V1\Employee\ValueObjects;

class Phone
{
    public function __construct(private string $phone)
    {
        if (!preg_match('/^\+?\d{10,15}$/', $phone)) {
            throw new \InvalidArgumentException("Invalid phone number format.");
        }
    }

    public function getPhone(): string
    {
        return $this->phone;
    }

    public function __toString(): string
    {
        return $this->phone;
    }
}
