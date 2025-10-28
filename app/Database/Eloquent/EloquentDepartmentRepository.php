<?php
namespace App\Database\Eloquent;

use App\Domain\Department\Entities\Department;
use App\Domain\Department\Repositories\DepartmentRepositoryInterface;
use App\Models\Department as DepartmentModel;

class EloquentDepartmentRepository implements DepartmentRepositoryInterface
{
    public function save(Department $department): Department
    {
        $data = [
            'name' => $department->name(),
            'code' => $department->code(),
            'manager_id' => $department->managerId(),
            'description' => $department->description(),
        ];

        $departmentModel = DepartmentModel::updateOrCreate(
            ['id' => $department->id()],
            $data
        );
dd($departmentModel);
        return new Department(
            id: $departmentModel->id,
            name: $departmentModel->name,
            code: $departmentModel->code,
            managerId: $departmentModel->manager_id,
            description: $departmentModel->description
        );
    }

    public function findById(int $id): ?Department
    {
        $departmentModel = DepartmentModel::find($id);

        if (!$departmentModel) {
            return null;
        }

        return new Department(
            id: $departmentModel->id,
            name: $departmentModel->name,
            code: $departmentModel->code,
            managerId: $departmentModel->manager_id,
            description: $departmentModel->description
        );
    }

    public function delete(int $id): bool
    {
        $department = DepartmentModel::find($id);

        if ($department) {
            return $department->delete();
        }

        return false;
    }

    public function filterDepartment(array $filters): array
    {
        $query = DepartmentModel::query();

        if (!empty($filters['name'])) {
        $query->where('name', 'like', '%' . $filters['name'] . '%');
        }

        if (!empty($filters['code'])) {
            $query->where('code', 'like', '%' . $filters['code'] . '%');
        }

        if (!empty($filters['manager_id'])) {
            $query->where('gender', $filters['manager_id']);
        }

        if (!empty($filters['description'])) {
            $query->where('department_id', 'like', '%' . $filters['description'] . '%');
        }

        return $query->get()->toArray();
    }
}

