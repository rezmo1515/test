<?php
namespace App\Application\Department\UseCases;

use App\Domain\Department\Repositories\DepartmentRepositoryInterface;
use Illuminate\Support\Facades\DB;

class DeleteDepartmentUseCase
{
    private DepartmentRepositoryInterface $departmentRepository;

    public function __construct(DepartmentRepositoryInterface $departmentRepository)
    {
        $this->departmentRepository = $departmentRepository;
    }

    public function execute(int $id): bool
    {
        DB::beginTransaction();

        try {
            $department = $this->departmentRepository->findById($id);

            if (!$department) {
                throw new \Exception("Department not found");
            }

            $deleted = $this->departmentRepository->delete($id);

            if (!$deleted) {
                throw new \Exception("Failed to delete department");
            }

            DB::commit();

            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }
}
