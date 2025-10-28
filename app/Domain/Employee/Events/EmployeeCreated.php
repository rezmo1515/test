<?php
namespace App\Domain\Employee\Events;
use App\Domain\Employee\Entities\Employee;

class EmployeeCreated { public function __construct(public Employee $employee) {} }
