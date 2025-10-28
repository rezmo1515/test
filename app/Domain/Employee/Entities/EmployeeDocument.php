<?php
namespace App\Domain\Employee\Entities;

use DateTimeImmutable;

final class EmployeeDocument
{
    public function __construct(
        private ?int $id,
        private int $employeeId,
        private string $type,
        private ?string $filePath,
        private ?string $description,
    ) {}

    public function id(): ?int { return $this->id; }
    public function employeeId(): int { return $this->employeeId; }
    public function type(): string { return $this->type; }
    public function number(): ?string { return $this->number; }
    public function filePath(): ?string { return $this->filePath; }
    public function description(): ?string { return $this->description; }
}
