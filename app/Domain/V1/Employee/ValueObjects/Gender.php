<?php
namespace App\Domain\V1\Employee\ValueObjects;

class Gender
{
    private string $value;

    private const VALID_GENDERS = ['male', 'female'];

    public function __construct(string $value)
    {
        if (!in_array($value, self::VALID_GENDERS)) {
            throw new \InvalidArgumentException("Invalid gender value: {$value}");
        }

        $this->value = $value;
    }

    public static function male(): self
    {
        return new self('male');
    }

    public static function female(): self
    {
        return new self('female');
    }

    public static function fromString(string $value): self
    {
        return new self($value);
    }

    public function getValue(): string
    {
        return $this->value;
    }

    public function __toString(): string
    {
        return $this->value;
    }

    public static function isValidGender(string $value): bool
    {
        return in_array($value, self::VALID_GENDERS);
    }
}
