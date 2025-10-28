<?php

namespace App\Application\RollCall\UseCases;

use App\Models\RollCall;

class UpdateRollCallUseCase
{
    public function execute(RollCall $rollCall, array $data): RollCall
    {
        $rollCall->update($data);
        return $rollCall;
    }
}

