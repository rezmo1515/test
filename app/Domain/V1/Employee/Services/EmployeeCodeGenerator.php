<?php

namespace App\Domain\V1\Employee\Services;

use App\Domain\V1\Employee\Repositories\EmployeeRepositoryInterface;
use Carbon\Carbon;

class EmployeeCodeGenerator
{
    public function __construct(private EmployeeRepositoryInterface $employeeRepository) {}

    /**
     * Generate a unique employee code.
     *
     * @return string
     */
    public function generate(): string
    {
        $currentYear = Carbon::now()->year;

        $lastEmployee = $this->employeeRepository->getLastEmployee();

        $nextCodeNumber = $lastEmployee ? (int) substr($lastEmployee->employeeCode, -4) + 1 : 1;

        $employeeCode = sprintf("%s-%04d", $currentYear, $nextCodeNumber);

        return $employeeCode;
    }
}
