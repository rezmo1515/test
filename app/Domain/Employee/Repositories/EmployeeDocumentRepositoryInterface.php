<?php

namespace App\Domain\Employee\Repositories;

use App\Domain\Employee\Entities\EmployeeDocument;

interface EmployeeDocumentRepositoryInterface
{
    public function add(EmployeeDocument $document): EmployeeDocument;
    public function listByEmployeeId(int $employeeId): array;
    public function delete(int $employeeId): bool;

}
