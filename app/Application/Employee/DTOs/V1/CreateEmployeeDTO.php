<?php
namespace App\Application\Employee\DTOs\V1;

use Carbon\Carbon;

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
}
