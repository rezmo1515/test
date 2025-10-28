<?php

namespace App\Application\Employee\UseCases;

use App\Domain\Employee\Entities\EmployeeContact;
use App\Domain\Employee\Repositories\EmployeeContactRepositoryInterface;

final class UpsertEmployeeContactUseCase
{
    public function __construct(private EmployeeContactRepositoryInterface $repo) {}

    public function execute(int $employeeId, array $data): EmployeeContact
    {
        $entity = new EmployeeContact(
            id: null,
            employeeId: $employeeId,
            workEmail: $data['work_email'] ?? null,
            personalEmail: $data['personal_email'] ?? null,
            mobile: $data['mobile'] ?? null,
            phone: $data['phone'] ?? null,
            emergencyName: $data['emergency_name'] ?? null,
            emergencyPhone: $data['emergency_phone'] ?? null,
        );
        return $this->repo->upsert($entity);
    }
}
