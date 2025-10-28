<?php
namespace App\Application\Position\UseCases;

use App\Domain\Position\Repositories\PositionRepositoryInterface;

class ViewPositionUseCase
{
    private PositionRepositoryInterface $positionRepository;

    public function __construct(PositionRepositoryInterface $positionRepository)
    {
        $this->positionRepository = $positionRepository;
    }

    public function execute(array $filters)
    {
        return $this->positionRepository->filterPosition($filters);
    }
}
