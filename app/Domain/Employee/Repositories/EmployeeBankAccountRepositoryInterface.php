<?php

namespace App\Domain\Employee\Repositories;

use App\Domain\Employee\Entities\EmployeeBankAccount;

interface EmployeeBankAccountRepositoryInterface
{
    public function add(EmployeeBankAccount $account): EmployeeBankAccount;
    public function listByEmployeeId(int $employeeId): array;
    public function delete(int $employeeId): bool;
}
