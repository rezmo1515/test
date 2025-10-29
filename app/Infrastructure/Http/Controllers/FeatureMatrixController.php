<?php

namespace App\Infrastructure\Http\Controllers;

use Illuminate\Http\JsonResponse;

final class FeatureMatrixController extends ApiController
{
    public function __invoke(): JsonResponse
    {
        $matrix = config('feature_matrix');

        $rows = $matrix['rows'] ?? [];
        $meta = [
            'updated_at' => $matrix['updated_at'] ?? null,
        ];

        return $this->success([
            'rows' => $rows,
            'meta' => $meta,
        ]);
    }
}
