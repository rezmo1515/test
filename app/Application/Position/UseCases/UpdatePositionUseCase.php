<?php
namespace App\Application\Position\UseCases;

use App\Domain\Position\Entities\Position;
use App\Domain\Position\Repositories\PositionRepositoryInterface;

class UpdatePositionUseCase
{
    private PositionRepositoryInterface $positionRepository;

    public function __construct(PositionRepositoryInterface $positionRepository)
    {
        $this->positionRepository = $positionRepository;
    }

    public function execute(int $id, array $data): Position
    {
        $position = $this->positionRepository->findById($id);

        if (!$position) {
            throw new \Exception("Department not found");
        }

        if (isset($data['title'])) {
            $position->setTitle($data['title']);
        }

        if (isset($data['code'])) {
            $position->setCode($data['code']);
        }

        if (isset($data['department_id'])) {
            $position->setDepartmentId($data['department_id']);
        }

        if (isset($data['description'])) {
            $position->setDescription($data['description']);
        }

        return $this->positionRepository->save($position);
    }
}
