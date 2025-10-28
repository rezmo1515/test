<?php

namespace App\Domain\Employee\Entities;

final class EmployeeContact
{
    public function __construct(
        private ?int $id,
        private int $employeeId,
        private ?string $workEmail,
        private ?string $personalEmail,
        private ?string $mobile,
        private ?string $phone,
        private ?string $emergencyName,
        private ?string $emergencyPhone,
        private ?string $address = null,
        private ?string $postalCode = null,
    ) {}

    public function id(): ?int { return $this->id; }
    public function employeeId(): int { return $this->employeeId; }
    public function workEmail(): ?string { return $this->workEmail; }
    public function personalEmail(): ?string { return $this->personalEmail; }
    public function mobile(): ?string { return $this->mobile; }
    public function phone(): ?string { return $this->phone; }
    public function emergencyName(): ?string { return $this->emergencyName; }
    public function emergencyPhone(): ?string { return $this->emergencyPhone; }
    public function address(): ?string { return $this->address; }
    public function postalCode(): ?string { return $this->postalCode; }
}
