<?php

namespace App\Application\User\UseCases\V1;

use App\Application\User\DTOs\V1\RegisterUserDTO;
use App\Domain\V1\User\Events\UserRegistered;
use App\Domain\V1\User\Repositories\UserRepositoryInterface;
use App\Domain\V1\User\Services\UserService;
use App\Domain\V1\User\ValueObjects\Email;
use App\Domain\V1\User\Entities\User;

class RegisterUserUseCase
{
    public function __construct(
        private UserRepositoryInterface $userRepository,
        private UserService $hasher
    ) {}

    public function execute(RegisterUserDTO $dto): User
    {
        $email = new Email($dto->email);
        $passwordHash = $this->hasher->hashPassword($dto->password);
        $user = new User($dto->username, new Email($dto->email), $passwordHash, true /* active */, null /* lastLogin */);

        $this->userRepository->save($user);

        // Dispatch domain event
        event(new UserRegistered($user));

        return $user;
    }
}
