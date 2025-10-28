<?php

namespace App\Application\RollCall\UseCases;

use App\Models\RollCall;

class ShowRollCallUseCase
{
    public function execute(array $filters = []): array
    {
        $query = RollCall::query();

        if (isset($filters['employee_id'])) {
            $query->where('employee_id', $filters['employee_id']);
        }

        return [
            'data' => $query->latest()->limit(100)->get(),
        ];
    }
}

