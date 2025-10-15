<?php

namespace App\Application\User\UseCases\V1;

use App\Domain\V1\User\Entities\User;
use App\Domain\V1\User\ValueObjects\Email;
use App\Domain\V1\User\ValueObjects\Username;
use App\Domain\V1\User\ValueObjects\Password;
use App\Domain\V1\User\Repositories\UserRepositoryInterface;
use App\Domain\V1\Employee\Entities\Employee;

class CreateUserForPrincipalUseCase
{
    public function __construct(
        private UserRepositoryInterface $userRepository
    ) {}

    public function execute(
        string $username,
        string $email,
        string $rawPassword,
        bool $active,
        int $employeeId
    ): User {
        $emailVO = new Email($email);
        $passwordHash = password_hash($rawPassword, PASSWORD_BCRYPT);

        $user = new User(
            $username,
            $emailVO,
            $passwordHash,
            $active ? true : false,
            null
        );

        // Save user
        $user = $this->userRepository->save($user);

        // Now link the user to the employee
        $employee = Employee::find($employeeId);
        if ($employee) {
            $employee->linkToUser($user);  // Assuming Employee has linkToUser method
            // Save the employee again after linking
            $employee->save();
        }

        return $user;
    }
}
