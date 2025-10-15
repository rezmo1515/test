<?php // Events/EmployeeCreated.php
namespace App\Domain\V1\Employee\Events;
use App\Domain\V1\Employee\Entities\Employee;

class EmployeeCreated { public function __construct(public Employee $employee) {} }
