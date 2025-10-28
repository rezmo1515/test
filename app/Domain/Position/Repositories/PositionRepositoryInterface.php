<?php
namespace App\Domain\Position\Repositories;

use App\Domain\Position\Entities\Position;

interface PositionRepositoryInterface
{
    public function save(Position $position): Position;
    public function findById(int $id): ?Position;
    public function delete(int $id): bool;
    public function filterPosition(array $filters): array;
}
