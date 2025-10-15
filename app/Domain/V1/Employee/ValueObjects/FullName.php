<?php

namespace App\Domain\V1\Employee\ValueObjects;

class FullName
{
    public function __construct(
        public string $firstName,
        public string $lastName
    ) {
        // Validate that both names are not empty
        if (empty($firstName) || empty($lastName)) {
            throw new \InvalidArgumentException("First and last name cannot be empty.");
        }
    }

    public function __toString(): string
    {
        return "{$this->firstName} {$this->lastName}";
    }
}
