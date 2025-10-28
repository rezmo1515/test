<?php

namespace App\Domain\Employee\Entities;

final class EmployeeBankAccount
{
    public function __construct(
        private ?int $id,
        private int $employeeId,
        private ?string $bankName,
        private ?string $accountNumber,
        private ?string $shebaNumber,
        private ?string $cardNumber,
        private bool $isPrimary = false,
    ) {}

    public function id(): ?int { return $this->id; }
    public function employeeId(): int { return $this->employeeId; }
    public function bankName(): ?string { return $this->bankName; }
    public function accountNumber(): ?string { return $this->accountNumber; }
    public function shebaNumber(): ?string { return $this->shebaNumber; }
    public function cardNumber(): ?string { return $this->cardNumber; }
    public function isPrimary(): bool { return $this->isPrimary; }
}
