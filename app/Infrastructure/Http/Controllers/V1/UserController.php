<?php
namespace App\Infrastructure\Http\Controllers\V1;

use App\Domain\V1\User\Entities\User;
use App\Infrastructure\Http\Controllers\ApiController;
use App\Infrastructure\Http\Requests\V1\User\UserRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends ApiController
{
    public function login(UserRequest $request): JsonResponse
    {
        $credentials = $request->validated();

        if (!Auth::attempt($credentials)) {
            return $this->failure('Invalid credentials', 422);
        }

        /** @var User $user */
        $user = $request->user();

        $token = $user->createToken('api')->plainTextToken;

        return $this->success([
            'token' => $token,
        ], 'Logged in');
    }

    public function logout(Request $request): JsonResponse
    {
        /** @var User $user */
        $user = $request->user();
        $user->currentAccessToken()?->delete();

        return $this->success(message: 'Logged out');
    }
}
