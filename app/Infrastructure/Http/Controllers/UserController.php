<?php
namespace App\Infrastructure\Http\Controllers;

use App\Domain\User\Services\UserService;
use App\Infrastructure\Http\Requests\User\UserRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UserController extends ApiController
{
    protected UserService $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function login(UserRequest $request): JsonResponse
    {
        $payload = $this->userService->login($request->validated(), $request);

        if (!($payload['success'] ?? false)) {
            return $this->failure($payload['message'] ?? 'Login failed', 422);
        }

        return $this->success($payload['data'] ?? null, $payload['message'] ?? 'Logged in successfully', 200);
    }
    public function logout(Request $request): JsonResponse
    {
        $result = $this->userService->logout($request);

        if (!($result['loggedOut'] ?? false)) {
            return $this->failure('No active token/session to revoke', 400);
        }

        return $this->success($result, 'Logged out successfully', 200);
    }

    public function show()
    {
        try {
            return $this->success($this->userService->show());
        } catch (\Throwable $exception) {
            return $this->failure($exception->getMessage());
        }
    }
}
