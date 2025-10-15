<?php

namespace App\Application\Employee\UseCases\V1;

use App\Application\Employee\DTOs\V1\CreateEmployeeDTO;
use App\Domain\V1\Employee\Entities\Employee;
use App\Domain\V1\Employee\Events\{EmployeeCreated, EmployeeAccountRequested};
use App\Domain\V1\Employee\Repositories\EmployeeRepositoryInterface;
use App\Domain\V1\Employee\ValueObjects\{FullName, Email, Phone, Address, Gender, NationalId};
use Carbon\Carbon;

class CreateEmployeeUseCase
{
    public function __construct(private EmployeeRepositoryInterface $repo) {}

    public function execute(CreateEmployeeDTO $d): Employee
    {
        // Create the Employee entity
        $employee = new Employee(
            id: null, // The ID will be generated later by the repository
            name: new FullName($d->firstName, $d->lastName),
            gender: match($d->gender) {
                'male' => Gender::male(),
                'female' => Gender::female(),
                default => Gender::fromString($d->gender),
            },
            birthDate: $d->birthDate ? Carbon::parse($d->birthDate) : null,
            nationalId: new NationalId($d->nationalId),
            workEmail: $d->workEmail ? new Email($d->workEmail) : null,
            personalEmail: $d->personalEmail ? new Email($d->personalEmail) : null,
            phone: $d->phone ? new Phone($d->phone) : null,
            address: $d->address ? new Address($d->address) : null,
            employeeCode: $this->repo->nextCode(), // Assume this generates the employee code
            departmentId: $d->departmentId,
            positionId: $d->positionId,
            managerId: $d->managerId,
            jobLevel: $d->jobLevel,
            locationId: $d->locationId,
            hireDate: $d->hireDate ? Carbon::parse($d->hireDate) : null,
            profileCompleted: false, // Default to false (will be set later)
            userId: null, // We’ll link user after the employee is created
        );

        // Save the employee to generate the ID
        $employee = $this->repo->save($employee);

        // Dispatch the EmployeeCreated event
        event(new EmployeeCreated($employee));

        // If portal account creation is required, create the user
        if ($d->createPortalAccount && $d->portalUsername && $d->portalPassword) {
            event(new EmployeeAccountRequested($employee, $d->portalUsername, $d->portalPassword));
        }

        return $employee;
    }
}
