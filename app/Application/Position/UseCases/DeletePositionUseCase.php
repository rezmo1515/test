<?php
namespace App\Application\Position\UseCases;

use App\Domain\Position\Repositories\PositionRepositoryInterface;
use Illuminate\Support\Facades\DB;

class DeletePositionUseCase
{
    private PositionRepositoryInterface $positionRepository;

    public function __construct(PositionRepositoryInterface $positionRepository)
    {
        $this->positionRepository = $positionRepository;
    }

    public function execute(int $id): bool
    {
        DB::beginTransaction();

        try {
            $position = $this->positionRepository->findById($id);

            if (!$position) {
                throw new \Exception("Position not found");
            }

            $deleted = $this->positionRepository->delete($id);

            if (!$deleted) {
                throw new \Exception("Failed to delete position");
            }

            DB::commit();

            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }
}
