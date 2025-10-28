<?php
namespace App\Application\Department\UseCases;

use App\Domain\Department\Entities\Department;
use App\Domain\Department\Repositories\DepartmentRepositoryInterface;
use Illuminate\Support\Facades\DB;

class UpdateDepartmentUseCase
{
    private DepartmentRepositoryInterface $departmentRepository;

    public function __construct(DepartmentRepositoryInterface $departmentRepository)
    {
        $this->departmentRepository = $departmentRepository;
    }

    public function execute(int $id, array $data): Department
    {
        DB::beginTransaction();

        try {
            $department = $this->departmentRepository->findById($id);

            if (!$department) {
                throw new \Exception("Department not found");
            }

            $fillableFields = [
                'name' => 'setName',
                'code' => 'setCode',
                'manager_id' => 'setManagerId',
                'description' => 'setDescription'
            ];

            foreach ($fillableFields as $field => $method) {
                if (isset($data[$field])) {
                    $department->{$method}($data[$field]);
                }
            }

            $updatedDepartment = $this->departmentRepository->save($department);

            DB::commit();

            return $updatedDepartment;
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }
}
