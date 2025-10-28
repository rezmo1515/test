<?php
namespace App\Application\Department\UseCases;

use App\Application\Department\DTOs\DepartmentDTO;
use App\Domain\Department\Entities\Department;
use App\Domain\Department\Repositories\DepartmentRepositoryInterface;
use Illuminate\Support\Facades\DB;

class CreateDepartmentUseCase
{
    private DepartmentRepositoryInterface $departmentRepository;

    public function __construct(DepartmentRepositoryInterface $departmentRepository)
    {
        $this->departmentRepository = $departmentRepository;
    }

    public function execute(DepartmentDTO $dto): Department
    {
        DB::beginTransaction();

        try {
            $department = new Department(
                id: null,
                name: $dto->name,
                code: $dto->code,
                managerId: $dto->managerId,
                description: $dto->description
            );

            $savedDepartment = $this->departmentRepository->save($department);

            DB::commit();

            return $savedDepartment;
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }
}
