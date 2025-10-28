<?php

namespace App\Domain\Employee\Repositories;

use App\Domain\Employee\Entities\EmployeeJob;

interface EmployeeJobRepositoryInterface
{
    public function upsert(EmployeeJob $job): EmployeeJob;
    public function findByEmployeeId(int $employeeId): ?EmployeeJob;
    public function delete(int $employeeId): bool;

}
