<?php
namespace App\Infrastructure\Http\Controllers\V1;

use App\Application\Employee\DTOs\V1\CreateEmployeeDTO;
use App\Application\Employee\UseCases\V1\CreateEmployeeUseCase;
use App\Infrastructure\Http\Requests\V1\Employee\EmployeeStoreRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller;

class EmployeeController extends Controller
{
    public function __construct(private CreateEmployeeUseCase $useCase) {}

    public function store(EmployeeStoreRequest $request): JsonResponse
    {
        $v = $request->validated();

        $dto = new CreateEmployeeDTO(
            firstName: $v['first_name'],
            lastName:  $v['last_name'],
            gender:    $v['gender'],
            birthDate: $v['birth_date'] ?? null,
            nationalId:$v['national_id'],
            workEmail: $v['work_email'] ?? null,
            personalEmail: $v['personal_email'] ?? null,
            phone:     $v['phone'] ?? null,
            address:   $v['address'] ?? null,
            departmentId: $v['department_id'] ?? null,
            positionId:   $v['position_id'] ?? null,
            managerId:    $v['manager_id'] ?? null,
            jobLevel:     $v['job_level'] ?? null,
            locationId:   $v['location_id'] ?? null,
            hireDate:     $v['hire_date'] ?? null,
            baseSalary:   $v['base_salary'] ?? null,
            languages:    $v['languages'] ?? [],
            certificates: $v['certificates'] ?? [],
            createPortalAccount: (bool)($v['create_portal_account'] ?? false),
            portalUsername: $v['portal_username'] ?? null,
            portalPassword: $v['portal_password'] ?? null,
        );

        $employee = $this->useCase->execute($dto);

        return response()->json([
            'message'  => 'Employee created',
            'employee' => [
                'id'   => $employee->id(),
                'code' => $employee->code(),
                'email'=> (string)($employee->workEmail()?->value() ?? ''),
            ],
        ], 201);
    }
}
