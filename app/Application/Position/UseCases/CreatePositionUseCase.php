<?php
namespace App\Application\Position\UseCases;

use App\Application\Position\DTOs\CreatePositionDTO;
use App\Domain\Position\Entities\Position;
use App\Domain\Position\Repositories\PositionRepositoryInterface;
use Illuminate\Support\Facades\DB;

class CreatePositionUseCase
{
    private PositionRepositoryInterface $positionRepository;

    public function __construct(PositionRepositoryInterface $positionRepository)
    {
        $this->positionRepository = $positionRepository;
    }

    public function execute(CreatePositionDTO $dto): Position
    {
        DB::beginTransaction();

        try {
            $position = new Position(
                id: null,
                title: $dto->title,
                code: $dto->code,
                departmentId: $dto->department_id,
                description: $dto->description
            );

            $savedPosition = $this->positionRepository->save($position);

            DB::commit();

            return $savedPosition;
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }
}
