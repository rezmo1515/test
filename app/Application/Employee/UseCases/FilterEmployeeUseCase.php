<?php // app/Application/Employee/UseCases/FilterEmployeeUseCase.php
namespace App\Application\Employee\UseCases;

use App\Domain\Employee\Repositories\EmployeeRepositoryInterface;

final class FilterEmployeeUseCase
{
    public function __construct(private EmployeeRepositoryInterface $repo) {}

    public function execute(array $filters): array
    {
        return $this->repo->filter($filters);
    }
}
