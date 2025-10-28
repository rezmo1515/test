<?php

namespace App\Infrastructure\Http\Controllers;

use App\Domain\Employee\Services\EmployeeService;
use App\Infrastructure\Http\Requests\Employee\ShowEmployeeRequest;
use App\Infrastructure\Http\Requests\Employee\StoreEmployeeRequest;
use App\Infrastructure\Http\Requests\Employee\UpdateEmployeeRequest;
use App\Models\Employee;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\JsonResponse;
use Throwable;

final class EmployeeController extends ApiController
{
    protected EmployeeService $employeeService;

    public function __construct(EmployeeService $employeeService)
    {
        $this->employeeService = $employeeService;
    }

    public function store(StoreEmployeeRequest $request): JsonResponse
    {
        try {
            $this->authorize('create', Employee::class);
            return $this->success($this->employeeService->store($request->validated()));
        } catch (Throwable $e) {
            return $this->failure($e->getMessage() ?: 'Unable to create employee right now.');
        }
    }

    public function update(UpdateEmployeeRequest $request, Employee $employee): JsonResponse
    {
        try {
            $this->authorize('update', $employee);

            return $this->success($this->employeeService->update($employee, $request->validated()));
        } catch (Throwable $e) {
            return $this->failure($e->getMessage() ?: 'Unable to update employee.');
        }
    }

    public function destroy(Employee $employee): JsonResponse
    {
        try {
            $this->authorize('delete', $employee);

            return $this->success($this->employeeService->delete($employee));
        } catch (Throwable $e) {
            return $this->failure($e->getMessage() ?: 'Unable to delete employee.', 500);
        }
    }

    public function index(ShowEmployeeRequest $request): JsonResponse
    {
        $filters = $request->only([
            'first_name',
            'personnel_code',
            'department_id',
            'hire_date',
            'employment_status',
        ]);

        try {
            $this->authorize('index', Employee::class);

            $employees = $this->employeeService->show($filters);

            return $this->success($employees);
        } catch (Throwable $e) {
            return $this->failure($e->getMessage() ?: 'Unable to fetch employee.');
        }
    }
}
