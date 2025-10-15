<?php // Events/EmployeeAccountRequested.php
namespace App\Domain\V1\Employee\Events;
use App\Domain\V1\Employee\Entities\Employee;

class EmployeeAccountRequested {
    public function __construct(public Employee $employee, public string $username, public string $rawPassword) {}
}
