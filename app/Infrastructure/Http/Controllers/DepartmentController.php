<?php
namespace App\Infrastructure\Http\Controllers;

use App\Domain\Department\Services\DepartmentService;
use App\Infrastructure\Http\Requests\Department\ShowDepartmentRequest;
use App\Infrastructure\Http\Requests\Department\StoreDepartmentRequest;
use App\Infrastructure\Http\Requests\Department\UpdateDepartmentRequest;
use App\Models\Department;
use Illuminate\Http\JsonResponse;
use Throwable;

final class DepartmentController extends ApiController
{
    protected DepartmentService $departmentService;

    public function __construct(DepartmentService $departmentService)
    {
        $this->departmentService = $departmentService;
    }

    public function store(StoreDepartmentRequest $request): JsonResponse
    {
        try {
            $this->authorize('create', Department::class);

            return $this->success($this->departmentService->create($request->validated()));
        } catch (Throwable $e) {
            return $this->failure($e->getMessage() ?: 'Unable to create department right now.');
        }
    }

    public function update(UpdateDepartmentRequest $request, Department $department): JsonResponse
    {
        try {
            $this->authorize('update', $department);

            return $this->success($this->departmentService->update($department->id, $request->validated()));
        } catch (Throwable $e) {
            return $this->failure($e->getMessage() ?: 'Unable to update department.');
        }
    }

    public function destroy(Department $department): JsonResponse
    {
        try {
            $this->authorize('delete', $department);

            return $this->success($this->departmentService->delete($department->id));
        } catch (Throwable $e) {
            return $this->failure($e->getMessage() ?: 'Unable to delete department.', 500);
        }
    }

    public function index(ShowDepartmentRequest $request): JsonResponse
    {
        $filters = $request->only([
            'name',
            'code',
            'manager_id',
            'description'
        ]);

        try {
            $this->authorize('index', Department::class);

            $departments = $this->departmentService->show($filters);

            return $this->success($departments);
        } catch (Throwable $e) {
            return $this->failure($e->getMessage() ?: 'Unable to fetch departments.');
        }
    }
}
