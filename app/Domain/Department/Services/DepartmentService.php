<?php
namespace App\Domain\Department\Services;

use App\Application\Department\DTOs\DepartmentDTO;
use App\Application\Department\UseCases\CreateDepartmentUseCase;
use App\Application\Department\UseCases\DeleteDepartmentUseCase;
use App\Application\Department\UseCases\UpdateDepartmentUseCase;
use App\Application\Department\UseCases\ViewDepartmentUseCase;

class DepartmentService
{
    protected CreateDepartmentUseCase $createDepartmentUseCase;
    protected UpdateDepartmentUseCase $updateDepartmentUseCase;
    protected DeleteDepartmentUseCase $deleteDepartmentUseCase;
    protected ViewDepartmentUseCase $viewDepartmentUseCase;

    public function __construct(
        CreateDepartmentUseCase $createDepartmentUseCase,
        UpdateDepartmentUseCase $updateDepartmentUseCase,
        DeleteDepartmentUseCase $deleteDepartmentUseCase,
        ViewDepartmentUseCase $viewDepartmentUseCase
    ) {
        $this->createDepartmentUseCase = $createDepartmentUseCase;
        $this->updateDepartmentUseCase = $updateDepartmentUseCase;
        $this->deleteDepartmentUseCase = $deleteDepartmentUseCase;
        $this->viewDepartmentUseCase = $viewDepartmentUseCase;
    }

    /**
     * Handle department creation
     *
     * @param array $data
     * @return array
     */
    public function create(array $data): array
    {
        $dto = DepartmentDTO::fromArray($data);
        $department = $this->createDepartmentUseCase->execute($dto);

        return [
            'id' => $department->id(),
            'name' => $department->name(),
            'code' => $department->code(),
            'manager_id' => $department->managerId(),
            'description' => $department->description(),
            'status' => 'Department created successfully.',
            'status_code' => 201,
        ];
    }

    /**
     * Handle department update
     *
     * @param int $id
     * @param array $data
     * @return array
     */
    public function update(int $id, array $data): array
    {
        $department = $this->updateDepartmentUseCase->execute($id, $data);

        return [
            'id' => $department->id(),
            'name' => $department->name(),
            'code' => $department->code(),
            'manager_id' => $department->managerId(),
            'description' => $department->description(),
            'status' => 'Department updated successfully.',
            'status_code' => 200,
        ];
    }

    /**
     * Handle department deletion
     *
     * @param int $id
     * @return array
     */
    public function delete(int $id): array
    {
        $isDeleted = $this->deleteDepartmentUseCase->execute($id);

        return [
            'status' => $isDeleted ? 'Department deleted successfully.' : 'Department not found.',
            'status_code' => $isDeleted ? 200 : 404,
        ];
    }

    /**
     * Handle view department details
     *
     * @param int $id
     * @return array
     */
    public function show(array $filters): array
    {
        return $this->viewDepartmentUseCase->execute($filters);
    }
}
