<?php

namespace App\Application\Employee\UseCases;

use App\Application\Employee\DTOs\CreateEmployeeDTO;
use App\Domain\Employee\Entities\Employee;
use App\Domain\Employee\Repositories\EmployeeRepositoryInterface;
use App\Domain\User\Entities\User;
use App\Domain\User\Repositories\UserRepositoryInterface;
use DateTimeImmutable;
use Illuminate\Support\Facades\Hash;

final class CreateEmployeeIdentityUseCase
{
    public function __construct(
        private EmployeeRepositoryInterface $repo,
        private UserRepositoryInterface $users,
    ) {}

    public function execute(CreateEmployeeDTO $d): Employee
    {
        if ($d->createPortalAccount == true) {
            $username = $d->portalUsername ?: 'mh' . uniqid();
            $rawPassword = $d->portalPassword ?: bin2hex(random_bytes(8));

            $user = new User(
                id: null,
                username: $username,
                email: $d->contact['work_email'],
                passwordHash: Hash::make($rawPassword),
                active: true,
                lastLogin: null
            );
            $userId = $this->users->save($user);
        }

        $employee = new Employee(
            id: null,
            firstName: $d->firstName,
            lastName:  $d->lastName,
            gender:    $d->gender,
            birthDate: !empty($d->birthDate) ? new DateTimeImmutable($d->birthDate) : null,
            nationalId:$d->nationalId,
            fatherName:              $d->fatherName ?? null,
            birthCertificateNumber:  $d->birthCertificateNumber ?? null,
            birthPlace:              $d->birthPlace ?? null,
            maritalStatus:           $d->maritalStatus ?? null,
            childrenCount:           (int)($d->childrenCount ?? 0),
            userId: $userId ?? null,
            profileCompleted: false
        );


        return $this->repo->save($employee);
    }
}
