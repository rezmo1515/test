<?php

namespace App\Database\Eloquent;

use App\Domain\Employee\Entities\EmployeeContact as Entity;
use App\Domain\Employee\Repositories\EmployeeContactRepositoryInterface;
use App\Models\EmployeeContact as Model;

class EloquentEmployeeContactRepository implements EmployeeContactRepositoryInterface
{
    public function upsert(Entity $c): Entity
    {
        $data = [
            'employee_id' => $c->employeeId(),
            'work_email' => $c->workEmail(),
            'personal_email' => $c->personalEmail(),
            'mobile' => $c->mobile(),
            'phone' => $c->phone(),
            'emergency_name' => $c->emergencyName(),
            'emergency_phone' => $c->emergencyPhone(),
            'address' => $c->address(),
            'postal_code' => $c->postalCode(),
        ];

        $m = Model::updateOrCreate(['employee_id'=>$c->employeeId()], $data);
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
            workEmail: $m->work_email,
            personalEmail: $m->personal_email,
            mobile: $m->mobile,
            phone: $m->phone,
            emergencyName: $m->emergency_name,
            emergencyPhone: $m->emergency_phone,
            address: $m->address,
            postalCode: $m->postal_code,
        );
    }

    public function delete(int $employeeId): bool
    {
        $deletedCount = Model::where('employee_id', $employeeId)->delete();

        return $deletedCount > 0;
    }
}
