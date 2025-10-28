<?php

namespace App\Domain\RollCall\Services;

use App\Application\RollCall\DTOs\RollCallDTO;
use App\Application\RollCall\UseCases\{CreateRollCallUseCase,
    ShowRollCallDevice1,
    UpdateRollCallUseCase,
    DeleteRollCallUseCase,
    ShowRollCallUseCase};
use App\Models\RollCall;
use Illuminate\Support\Facades\DB;
use Throwable;

class RollCallService
{
    public function __construct(
        protected CreateRollCallUseCase $createUseCase,
        protected UpdateRollCallUseCase $updateUseCase,
        protected DeleteRollCallUseCase $deleteUseCase,
        protected ShowRollCallUseCase $showUseCase,
        protected ShowRollCallDevice1 $showDevice1,
    ) {}

    public function showDevice1(array $filter): array
    {
        return $this->showDevice1->execute($filter);
    }

    public function showDevice2(): array
    {
        return ['message' => 'Device 2 not connected yet'];
    }

    public function showDevice3(): array
    {
        return ['message' => 'Device 3 not connected yet'];
    }

    public function createEntry(array $data): array
    {
        $dto = RollCallDTO::fromArray($data);
        $rollCall = $this->createUseCase->execute($dto);
        return ['roll_call' => $rollCall, 'message' => 'Created successfully'];
    }

    public function updateEntry(RollCall $rollCall, array $data): array
    {
        $updated = $this->updateUseCase->execute($rollCall, $data);
        return ['roll_call' => $updated, 'message' => 'Updated successfully'];
    }

    public function deleteEntry(RollCall $rollCall): array
    {
        $deleted = $this->deleteUseCase->execute($rollCall);
        return ['message' => $deleted ? 'Deleted successfully' : 'Failed to delete'];
    }

    public function showEntries(array $filters): array
    {
        return $this->showUseCase->execute($filters);
    }
}
