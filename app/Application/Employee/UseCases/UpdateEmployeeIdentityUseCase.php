<?php

namespace App\Application\Employee\UseCases;

use App\Application\Employee\DTOs\CreateEmployeeDTO;
use App\Domain\Employee\Repositories\EmployeeRepositoryInterface;
use DateTimeImmutable;
use DomainException;

final class UpdateEmployeeIdentityUseCase
{
    public function __construct(
        private EmployeeRepositoryInterface $repo,
    )
    {}

    public function execute(int $employeeId, CreateEmployeeDTO $d)
    {
        $employee = $this->repo->findById($employeeId);

        if (!$employee) {
            throw new DomainException('Employee not found.');
        }

        foreach (get_object_vars($d) as $key => $value) {
            if ($value !== null && method_exists($employee, 'set' . ucfirst($key))) {
                $employee->{'set' . ucfirst($key)}($value);
            }
        }
        return $this->repo->save($employee);
    }
}
