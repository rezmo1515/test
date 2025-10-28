<?php

namespace App\Domain\User\Entities;

use DateTimeImmutable;

final class User
{
    public function __construct(
        private ?string $id,
        private string $username,
        private string $email,
        private string $passwordHash,
        private bool $active = true,
        private ?DateTimeImmutable $lastLogin = null,
    ) {}

    // Getters
    public function id(): ?string
    {
        return $this->id;
    }

    public function setId(string $id): void
    {
        $this->id = $id;
    }

    public function getUserName(): string
    {
        return $this->username;
    }

    public function getEmail(): string
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

    public function getLastLogin(): ?DateTimeImmutable
    {
        return $this->lastLogin ?? new \DateTimeImmutable('now', new \DateTimeZone('Asia/Tehran'));
    }

    public function recordLogin(): void
    {
        $this->lastLogin = new \DateTimeImmutable('now', new \DateTimeZone('Asia/Tehran'));
    }

    public function setUsername(string $username): void
    {
        $this->username = $username;
    }

    public function setPasswordHash(string $passwordHash): void
    {
        $this->passwordHash = $passwordHash;
    }
}
