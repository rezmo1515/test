<?php

namespace App\Database\Eloquent;

use App\Domain\Employee\Entities\EmployeeJob as Entity;
use App\Domain\Employee\Repositories\EmployeeJobRepositoryInterface;
use App\Models\EmployeeJob as Model;
use DateTimeImmutable;

class EloquentEmployeeJobRepository implements EmployeeJobRepositoryInterface
{
    public function upsert(Entity $j): Entity
    {
        $data = [
            'employee_id' => $j->employeeId(),
            'department_id'=> $j->departmentId(),
            'position_id'  => $j->positionId(),
            'manager_id'   => $j->managerId(),
            'employment_type'   => $j->employmentType(),
            'employment_status' => $j->employmentStatus(),
            'hire_date'    => $j->hireDate()?->format('Y-m-d'),
            'personnel_code' => $j->personnelCode(),
            'organization_unit_id' => $j->organizationUnitId(),
            'shift_type' => $j->shiftType(),
            'start_date' => $j->startDate()?->format('Y-m-d'),
        ];
        $m = Model::updateOrCreate(['employee_id'=>$j->employeeId()], $data);
        return $this->map($m);
    }

    public function findByEmployeeId(int $employeeId): ?Entity
    {
        $m = Model::where('employee_id',$employeeId)->first();
        return $m ? $this->map($m) : null;
    }

    private function map(Model $m): Entity
    {
        return new Entity(
            id: $m->id,
            employeeId: $m->employee_id,
            departmentId: $m->department_id,
            positionId: $m->position_id,
            managerId: $m->manager_id,
            employmentType: $m->employment_type,
            employmentStatus: $m->employment_status,
            hireDate: $m->hire_date ? new DateTimeImmutable($m->hire_date) : null,
            personnelCode: $m->personnel_code,
            organizationUnitId: $m->organization_unit_id,
            shiftType: $m->shift_type,
            startDate: $m->start_date ? new DateTimeImmutable($m->start_date) : null,
        );
    }

    public function delete(int $employeeId): bool
    {
        $deletedCount = Model::where('employee_id', $employeeId)->delete();

        return $deletedCount > 0;
    }
}
