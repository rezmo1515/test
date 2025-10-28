<?php
namespace App\Domain\Department\Repositories;

use App\Domain\Department\Entities\Department;

interface DepartmentRepositoryInterface
{
    public function save(Department $department): Department;
    public function findById(int $id): ?Department;
    public function delete(int $id): bool;
    public function filterDepartment(array $filters): array;
}
