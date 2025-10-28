<?php

namespace App\Domain\Employee\Entities;

use DateTimeImmutable;

final class Employee
{
    public function __construct(
        private ?int $id,
        private ?string $firstName,
        private ?string $lastName,
        private ?string $gender,
        private ?DateTimeImmutable $birthDate,
        private ?string $nationalId,
        // NEW identity fields
        private ?string $fatherName = null,
        private ?string $birthCertificateNumber = null,
        private ?string $birthPlace = null,
        private ?string $maritalStatus = null,     // single|married|divorced|widowed
        private int $childrenCount = 0,

        private ?int $userId = null,
        private bool $profileCompleted = false,
    ) {}

    // Getters
    public function id(): ?int { return $this->id; }
    public function firstName(): ?string { return $this->firstName; }
    public function lastName(): ?string { return $this->lastName; }
    public function gender(): ?string { return $this->gender; }
    public function birthDate(): ?DateTimeImmutable { return $this->birthDate; }
    public function nationalId(): ?string { return $this->nationalId; }

    public function fatherName(): ?string { return $this->fatherName; }
    public function birthCertificateNumber(): ?string { return $this->birthCertificateNumber; }
    public function birthPlace(): ?string { return $this->birthPlace; }
    public function maritalStatus(): ?string { return $this->maritalStatus; }
    public function childrenCount(): int { return $this->childrenCount; }

    public function userId(): ?int { return $this->userId; }
    public function profileCompleted(): bool { return $this->profileCompleted; }

    // Setters (only if needed)
    public function setFirstName(?string $v): void { $this->firstName = $v; }
    public function setLastName(?string $v): void { $this->lastName = $v; }
    public function setGender(?string $v): void { $this->gender = $v; }
    public function setBirthDate(?DateTimeImmutable $v): void { $this->birthDate = $v; }
    public function setNationalId(?string $v): void { $this->nationalId = $v; }
    public function setFatherName(?string $v): void { $this->fatherName = $v; }
    public function setBirthCertificateNumber(?string $v): void { $this->birthCertificateNumber = $v; }
    public function setBirthPlace(?string $v): void { $this->birthPlace = $v; }
    public function setMaritalStatus(?string $v): void { $this->maritalStatus = $v; }
    public function setChildrenCount(int $v): void { $this->childrenCount = $v; }
    public function setUserId(?int $v): void { $this->userId = $v; }
    public function setProfileCompleted(bool $v): void { $this->profileCompleted = $v; }
}
