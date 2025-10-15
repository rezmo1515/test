<?php
namespace App\Infrastructure\Http\Controllers\V1;

use App\Application\Employee\DTOs\V1\CreateEmployeeDTO;
use App\Application\Employee\UseCases\V1\CreateEmployeeUseCase;
use App\Infrastructure\Exceptions\ApiException;
use App\Infrastructure\Http\Controllers\ApiController;
use App\Infrastructure\Http\Requests\V1\Employee\EmployeeStoreRequest;
use Illuminate\Http\JsonResponse;
use Throwable;

class EmployeeController extends ApiController
{
    public function __construct(private CreateEmployeeUseCase $useCase) {}

    public function store(EmployeeStoreRequest $request): JsonResponse
    {
        $dto = CreateEmployeeDTO::fromArray($request->validated());

        try {
            $employee = $this->useCase->execute($dto);
        } catch (Throwable $e) {
            report($e);

            throw new ApiException('Unable to create employee right now.', 500, previous: $e);
        }

        return $this->created([
            'employee' => [
                'id' => $employee->id(),
                'code' => $employee->code(),
                'email' => (string)($employee->workEmail()?->value() ?? ''),
            ],
        ], 'Employee created');
    }
}
