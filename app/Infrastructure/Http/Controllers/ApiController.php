<?php

namespace App\Infrastructure\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller as BaseController;
/**
 * @OA\Info(
 *     title="ERP",
 *     version="1.0",
 *     description="API for Hanle and see request erp",
 *     @OA\Contact(
 *         email="mammadrezaa.021@gmail.com"
 *     )
 * )
 */
abstract class ApiController extends BaseController
{
    use AuthorizesRequests;
    protected function success(array $data = [], string $message = 'Success', int $status = 200): JsonResponse
    {
        $payload = [
            'status' => 'success',
            'message' => $message,
        ];

        if (!empty($data)) {
            $payload['data'] = $data;
        }

        return response()->json($payload, $status);
    }

    protected function created(array $data = [], string $message = 'Created'): JsonResponse
    {
        return $this->success($data, $message, 201);
    }

    protected function failure(string $message, int $status = 400, array $errors = []): JsonResponse
    {
        $payload = [
            'status' => 'error',
            'message' => $message,
        ];

        if (!empty($errors)) {
            $payload['errors'] = $errors;
        }

        return response()->json($payload, $status);
    }
}

