<?php

namespace App\Domain\Employee\Entities;

use DateTimeImmutable;

final class EmployeeJob
{
    public function __construct(
        private ?int $id,
        private int $employeeId,
        private ?int $departmentId,
        private ?int $positionId,
        private ?int $managerId,
        private ?string $employmentType,
        private ?string $employmentStatus,
        private ?DateTimeImmutable $hireDate,
        private ?string $personnelCode = null,
        private ?int $organizationUnitId = null,
        private ?string $shiftType = null,
        private ?DateTimeImmutable $startDate = null,
    ) {}

    public function id(): ?int { return $this->id; }
    public function employeeId(): int { return $this->employeeId; }
    public function departmentId(): ?int { return $this->departmentId; }
    public function positionId(): ?int { return $this->positionId; }
    public function managerId(): ?int { return $this->managerId; }
    public function employmentType(): ?string { return $this->employmentType; }
    public function employmentStatus(): ?string { return $this->employmentStatus; }
    public function hireDate(): ?DateTimeImmutable { return $this->hireDate; }

    public function personnelCode(): ?string { return $this->personnelCode; }
    public function organizationUnitId(): ?int { return $this->organizationUnitId; }
    public function shiftType(): ?string { return $this->shiftType; }
    public function startDate(): ?DateTimeImmutable { return $this->startDate; }
}
