<?php

namespace App\Application\Employee\Presenters\V1;

use App\Domain\V1\Employee\Entities\Employee;

class EmployeePresenter
{
    /**
     * Transform an Employee entity to an array suitable for API response.
     *
     * @param Employee $employee
     * @return array
     */
    public function toArray(Employee $employee): array
    {
        return [
            'id'            => $employee->id(),
            'employee_code' => $employee->code(),
            'full_name'     => (string) $employee->name(),
            'gender'        => $employee->gender()->getValue(),
            'work_email'    => (string) $employee->workEmail(),
            'phone'         => (string) $employee->phone(),
            'address'       => (string) $employee->address(),
            'hire_date'     => $employee->hireDate() ? $employee->hireDate()->toDateString() : null,
            'department_id' => $employee->departmentId(),
            'position_id'   => $employee->positionId(),
            'job_level'     => $employee->jobLevel(),
        ];
    }
}
