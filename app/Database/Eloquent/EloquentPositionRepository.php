<?php
namespace App\Database\Eloquent;

use App\Domain\Position\Entities\Position;
use App\Domain\Position\Repositories\PositionRepositoryInterface;
use App\Models\Position as PositionModel;

class EloquentPositionRepository implements PositionRepositoryInterface
{
    public function save(Position $position): Position
    {
        $data = [
            'title' => $position->title(),
            'code' => $position->code(),
            'department_id' => $position->departmentId(),
            'description' => $position->description(),
        ];

        $positionModel = PositionModel::updateOrCreate(
            ['id' => $position->id()],
            $data
        );

        return new Position(
            id: $positionModel->id,
            title: $positionModel->title,
            code: $positionModel->code,
            departmentId: $positionModel->department_id,
            description: $positionModel->description
        );
    }

    public function findById(int $id): ?Position
    {
        $positionModel = PositionModel::find($id);

        if (!$positionModel) {
            return null;
        }

        return new Position(
            id: $positionModel->id,
            title: $positionModel->title,
            code: $positionModel->code,
            departmentId: $positionModel->departmen_id,
            description: $positionModel->description
        );
    }

    public function delete(int $id): bool
    {
        $position = PositionModel::find($id);

        if ($position) {
            return $position->delete();
        }

        return false;
    }

    public function filterPosition(array $filters): array
    {
        $query = PositionModel::query();

        if (!empty($filters['title'])) {
            $query->where('title', 'like', '%' . $filters['title'] . '%');
        }

        if (!empty($filters['code'])) {
            $query->where('code', 'like', '%' . $filters['code'] . '%');
        }

        if (!empty($filters['department_id'])) {
            $query->where('gender', $filters['department_id']);
        }

        if (!empty($filters['description'])) {
            $query->where('department_id', 'like', '%' . $filters['description'] . '%');
        }

        return $query->get()->toArray();
    }
}

