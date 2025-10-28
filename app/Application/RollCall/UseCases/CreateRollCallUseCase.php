<?php

namespace App\Application\RollCall\UseCases;

use App\Application\RollCall\DTOs\RollCallDTO;
use App\Models\RollCall;

class CreateRollCallUseCase
{
    public function execute(RollCallDTO $dto): RollCall
    {
        return RollCall::create([
            'employee_id' => $dto->employee_id,
            'entry' => $dto->entry,
            'type' => $dto->type,
            'status' => $dto->status,
            'created_by' => $dto->created_by,
        ]);
    }
}

