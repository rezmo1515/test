<?php
namespace App\Domain\V1\Employee\Repositories;

use App\Domain\V1\Employee\Entities\Employee;

interface EmployeeRepositoryInterface {
    public function nextCode(): string;
    public function save(Employee $employee): Employee; // returns with id
    public function getLastEmployee(): Employee;
}
