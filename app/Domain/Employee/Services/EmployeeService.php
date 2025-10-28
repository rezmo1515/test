<?php

namespace App\Domain\Employee\Services;

use App\Application\Employee\DTOs\CreateEmployeeDTO;
use App\Application\Employee\UseCases\CreateEmployeeIdentityUseCase;
use App\Application\Employee\UseCases\DeleteEmployeeUseCase;
use App\Application\Employee\UseCases\FilterEmployeeUseCase;
use App\Application\Employee\UseCases\UpdateEmployeeIdentityUseCase;
use App\Application\Employee\UseCases\UpsertEmployeeContactUseCase;
use App\Application\Employee\UseCases\UpsertEmployeeJobUseCase;
use App\Application\Employee\UseCases\AddEmployeeBankAccountUseCase;
use App\Application\Employee\UseCases\AddEmployeeDocumentUseCase;
use App\Database\Eloquent\EloquentEmployeeRepository;
use App\Models\Employee;
use App\Models\Employee as EmployeeModel;
use Illuminate\Support\Facades\DB;
use Throwable;

class EmployeeService
{
    protected EloquentEmployeeRepository $employeeRepository;
    protected CreateEmployeeIdentityUseCase $createEmployeeIdentityUseCase;
    protected DeleteEmployeeUseCase $deleteEmployeeUseCase;
    protected FilterEmployeeUseCase $filterEmployeeUseCase;

    // new section use-cases
    protected UpsertEmployeeContactUseCase $upsertContactUseCase;
    protected UpsertEmployeeJobUseCase $upsertJobUseCase;
    protected AddEmployeeBankAccountUseCase $addBankAccountUseCase;
    protected AddEmployeeDocumentUseCase $addDocumentUseCase;
    protected UpdateEmployeeIdentityUseCase $updateEmployeeIdentityUseCase;

    public function __construct(
        EloquentEmployeeRepository $employeeRepository,
        CreateEmployeeIdentityUseCase $createEmployeeIdentityUseCase,
        DeleteEmployeeUseCase $deleteEmployeeUseCase,
        FilterEmployeeUseCase $filterEmployeeUseCase,
        UpsertEmployeeContactUseCase $upsertContactUseCase,
        UpsertEmployeeJobUseCase $upsertJobUseCase,
        AddEmployeeBankAccountUseCase $addBankAccountUseCase,
        AddEmployeeDocumentUseCase $addDocumentUseCase,
        UpdateEmployeeIdentityUseCase $updateEmployeeIdentityUseCase,
    ) {
        $this->employeeRepository = $employeeRepository;
        $this->createEmployeeIdentityUseCase = $createEmployeeIdentityUseCase;
        $this->deleteEmployeeUseCase = $deleteEmployeeUseCase;
        $this->filterEmployeeUseCase = $filterEmployeeUseCase;

        $this->upsertContactUseCase = $upsertContactUseCase;
        $this->upsertJobUseCase = $upsertJobUseCase;
        $this->addBankAccountUseCase = $addBankAccountUseCase;
        $this->addDocumentUseCase = $addDocumentUseCase;
        $this->updateEmployeeIdentityUseCase = $updateEmployeeIdentityUseCase;
    }

    public function store(array $data): array
    {
        $dto = CreateEmployeeDTO::fromArray($data);

        DB::beginTransaction();
        try {
            $employeeEntity = $this->createEmployeeIdentityUseCase->execute($dto);
            $employeeId = $employeeEntity->id();
            if (!empty($dto->contact)) {

                $this->upsertContactUseCase->execute($employeeId, $dto->contact);
            }

            if (!empty($dto->job)) {
                $this->upsertJobUseCase->execute($employeeId, $dto->job);
            }

            foreach ($dto->bankAccounts as $acc) {
                $this->addBankAccountUseCase->execute($employeeId, $acc);
            }

            foreach ($dto->documents as $doc) {
                $this->addDocumentUseCase->execute($employeeId, $doc);
            }

            DB::commit();

            return [
                'employee' => [
                    'id'    => $employeeEntity->id(),
                    'email' => $dto->contact['work_email'] ?? $dto->contact['personal_email'] ?? $employeeEntity->workEmail() ?? ''
                ],
                'message' => 'Employee created successfully.',
                'status' => 201
            ];
        } catch (Throwable $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function update(EmployeeModel $employee, array $data): array
    {
        $employeeEntity = Employee::find($employee->id);
        if (empty($employeeEntity)) {
            return [
                'employee' => [],
                'message' => 'Employee not found.',
                'status' => 404
            ];
        }

        $dto = CreateEmployeeDTO::fromArray($data);

        DB::beginTransaction();
        try {
            $this->updateEmployeeIdentityUseCase->execute($employee->id, $dto);

            if (!empty($dto->contact)) {
                $this->upsertContactUseCase->execute($employeeEntity->id, $dto->contact);
            }

            if (!empty($dto->job)) {
                $this->upsertJobUseCase->execute($employeeEntity->id, $dto->job);
            }

            if (!empty($dto->bankAccounts)) {
                foreach ($dto->bankAccounts as $acc) {
                    $this->addBankAccountUseCase->execute($employeeEntity->id, $acc);
                }
            }

            if (!empty($dto->documents)) {
                foreach ($dto->documents as $doc) {
                    $this->addDocumentUseCase->execute($employeeEntity->id, $doc);
                }
            }

            DB::commit();
            return [
                'employee' => [
                    'id'    => $employeeEntity->id,
                    'email' => $employee->contact->work_email ?? ''
                ],
                'message' => 'Employee updated successfully.',
                'status' => 200
            ];
        } catch (Throwable $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function delete(EmployeeModel $employee): array
    {
        $result = $this->deleteEmployeeUseCase->execute($employee->id);

        if ($result) {
            return ['message' => 'Employee deleted successfully', 'status' => 200];
        }
        return ['message' => 'Employee not found or could not be deleted', 'status' => 404];
    }

    public function show(array $filters): array
    {
        return $this->filterEmployeeUseCase->execute($filters);
    }
}
