<?php

namespace App\Domain\V1\Employee\ValueObjects;

class NationalId
{
    public function __construct(private string $id)
    {
        // Example: National ID should be numeric and of length 10
        if (!preg_match('/^\d{10}$/', $id)) {
            throw new \InvalidArgumentException("Invalid National ID format.");
        }
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function __toString(): string
    {
        return $this->id;
    }
}
