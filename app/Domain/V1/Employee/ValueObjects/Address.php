<?php

namespace App\Domain\V1\Employee\ValueObjects;

class Address
{
    public function __construct(
        private string $address,
    ) {
        if (empty($this->address)) {
            throw new \InvalidArgumentException("Address fields cannot be empty.");
        }
    }

    public function getFullAddress(): string
    {
        return "{$this->address}";
    }

    public function __toString(): string
    {
        return $this->getFullAddress();
    }
}
