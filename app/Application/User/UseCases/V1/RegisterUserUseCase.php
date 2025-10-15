<?php
namespace App\Application\User\UseCases\V1;

use App\Application\User\DTOs\V1\RegisterUserDTO;
use App\Domain\V1\User\Events\UserRegistered;
use App\Domain\V1\User\Repositories\UserRepositoryInterface;
use App\Domain\V1\User\Services\UserService;
use App\Domain\V1\User\Entities\User;

class RegisterUserUseCase
{
    public function __construct(
        private UserRepositoryInterface $userRepository,
        private UserService $hasher
    ) {}

    public function execute(RegisterUserDTO $dto): User
    {
        $passwordHash = $this->hasher->hashPassword($dto->password);

        $user = User::created([
            'username' => $dto->username,
            'email' => $dto->email,
            'password' => $passwordHash
        ]);

        $this->userRepository->save($user);

        event(new UserRegistered($user));

        return $user;
    }
}
