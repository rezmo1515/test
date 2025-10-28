<?php

namespace App\Application\Employee\UseCases;

use App\Domain\Employee\Entities\EmployeeBankAccount;
use App\Domain\Employee\Repositories\EmployeeBankAccountRepositoryInterface;

final class AddEmployeeBankAccountUseCase
{
    public function __construct(private EmployeeBankAccountRepositoryInterface $repo) {}

    public function execute(int $employeeId, array $data): EmployeeBankAccount
    {
        $entity = new EmployeeBankAccount(
            id: null,
            employeeId: $employeeId,
            bankName: $data['bank_name'] ?? null,
            accountNumber: $data['account_number'] ?? null,
            shebaNumber: $data['sheba_number'] ?? null,
            cardNumber: $data['card_number'] ?? null,
            isPrimary: (bool)($data['is_primary'] ?? false),
        );
        return $this->repo->add($entity);
    }
}
