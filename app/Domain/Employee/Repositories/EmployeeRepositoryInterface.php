<?php
namespace App\Domain\Employee\Repositories;

use App\Domain\Employee\Entities\Employee;

interface EmployeeRepositoryInterface
{
    public function save(Employee $e): Employee;
    public function findById(int $id): ?Employee;
    public function delete(int $id): bool;
    public function filter(array $filters): array;
}
