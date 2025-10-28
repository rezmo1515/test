<?php

namespace App\Application\Employee\UseCases;

use App\Domain\Employee\Entities\EmployeeJob;
use App\Domain\Employee\Repositories\EmployeeJobRepositoryInterface;
use DateTimeImmutable;

final class UpsertEmployeeJobUseCase
{
    public function __construct(private EmployeeJobRepositoryInterface $repo) {}

    public function execute(int $employeeId, array $data): EmployeeJob
    {
        $entity = new EmployeeJob(
            id: null,
            employeeId: $employeeId,
            departmentId: $data['department_id'] ?? null,
            positionId: $data['position_id'] ?? null,
            managerId: $data['manager_id'] ?? null,
            employmentType: $data['employment_type'] ?? null,
            employmentStatus: $data['employment_status'] ?? 'active',
            hireDate: !empty($data['hire_date']) ? new DateTimeImmutable($data['hire_date']) : null,
            personnelCode: $data['personnel_code'] ?? null,
        );
        return $this->repo->upsert($entity);
    }
}
