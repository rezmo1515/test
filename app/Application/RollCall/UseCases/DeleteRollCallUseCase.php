<?php

namespace App\Application\RollCall\UseCases;

use App\Models\RollCall;

class DeleteRollCallUseCase
{
    public function execute(RollCall $rollCall): bool
    {
        return $rollCall->delete();
    }
}
