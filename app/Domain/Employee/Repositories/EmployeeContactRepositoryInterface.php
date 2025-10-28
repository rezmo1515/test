<?php

namespace App\Domain\Employee\Repositories;

use App\Domain\Employee\Entities\EmployeeContact;

interface EmployeeContactRepositoryInterface
{
    public function upsert(EmployeeContact $contact): EmployeeContact;
    public function findByEmployeeId(int $employeeId): ?EmployeeContact;
    public function delete(int $employeeId): bool;

}
