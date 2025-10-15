<?php
namespace App\Application\Employee\DTOs\V1;

class CreateEmployeeDTO
{
    public function __construct(
        public string $firstName,
        public string $lastName,
        public string $gender,
        public ?string $birthDate,
        public string $nationalId,
        public ?string $workEmail,
        public ?string $personalEmail,
        public ?string $phone,
        public ?string $address,
        public ?int $departmentId,
        public ?int $positionId,
        public ?int $managerId,
        public ?string $jobLevel,
        public ?int $locationId,
        public ?string $hireDate,
        public ?int $baseSalary,
        public array $languages,
        public array $certificates,
        public bool $createPortalAccount,
        public ?string $portalUsername,
        public ?string $portalPassword
    ) {}

    public static function fromArray(array $payload): self
    {
        return new self(
            firstName: $payload['first_name'],
            lastName: $payload['last_name'],
            gender: $payload['gender'],
            birthDate: $payload['birth_date'] ?? null,
            nationalId: $payload['national_id'],
            workEmail: $payload['work_email'] ?? null,
            personalEmail: $payload['personal_email'] ?? null,
            phone: $payload['phone'] ?? null,
            address: $payload['address'] ?? null,
            departmentId: $payload['department_id'] ?? null,
            positionId: $payload['position_id'] ?? null,
            managerId: $payload['manager_id'] ?? null,
            jobLevel: $payload['job_level'] ?? null,
            locationId: $payload['location_id'] ?? null,
            hireDate: $payload['hire_date'] ?? null,
            baseSalary: $payload['base_salary'] ?? null,
            languages: $payload['languages'] ?? [],
            certificates: $payload['certificates'] ?? [],
            createPortalAccount: (bool)($payload['create_portal_account'] ?? false),
            portalUsername: $payload['portal_username'] ?? null,
            portalPassword: $payload['portal_password'] ?? null,
        );
    }
}
