<?php

namespace App\Database\Eloquent;

use App\Domain\Employee\Entities\EmployeeDocument as Entity;
use App\Domain\Employee\Repositories\EmployeeDocumentRepositoryInterface;
use App\Models\EmployeeDocument as Model;
use DateTimeImmutable;

class EloquentEmployeeDocumentRepository implements EmployeeDocumentRepositoryInterface
{
    public function add(Entity $d): Entity
    {
        $m = Model::updateOrCreate([
            'employee_id' => $d->employeeId(),
            'type' => $d->type(),
            'file_path' => $d->filePath(),
            'description' => $d->description(),
        ]);
        return $this->map($m);
    }

    public function listByEmployeeId(int $employeeId): array
    {
        return Model::where('employee_id', $employeeId)->get()->toArray();
    }

    private function map(Model $m): Entity
    {
        return new Entity(
            id: $m->id,
            employeeId: $m->employee_id,
            type: $m->type,
            filePath: $m->file_path,
            description: $m->description
        );
    }

    public function delete(int $employeeId): bool
    {
        $deletedCount = Model::where('employee_id', $employeeId)->delete();

        return $deletedCount > 0;
    }
}
