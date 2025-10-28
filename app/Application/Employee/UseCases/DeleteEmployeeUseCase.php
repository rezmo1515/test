<?php

namespace App\Application\Employee\UseCases;

use App\Domain\Employee\Repositories\EmployeeBankAccountRepositoryInterface;
use App\Domain\Employee\Repositories\EmployeeContactRepositoryInterface;
use App\Domain\Employee\Repositories\EmployeeDocumentRepositoryInterface;
use App\Domain\Employee\Repositories\EmployeeJobRepositoryInterface;
use App\Domain\Employee\Repositories\EmployeeRepositoryInterface;
use App\Domain\User\Repositories\UserRepositoryInterface;
use Illuminate\Support\Facades\DB;

final class DeleteEmployeeUseCase
{
    public function __construct(
        private EmployeeRepositoryInterface $employeeRepository,
        private UserRepositoryInterface $userRepository,
        private EmployeeBankAccountRepositoryInterface $employeeBankAccountRepository,
        private EmployeeContactRepositoryInterface $employeeContactRepository,
        private EmployeeDocumentRepositoryInterface $employeeDocumentRepository,
        private EmployeeJobRepositoryInterface $employeeJobRepository
    ) {}

    public function execute(int $id): bool
    {
        DB::beginTransaction();

        try {
            $employee = $this->employeeRepository->findById($id);
            if (!$employee) {
                throw new \Exception("Employee not found with id {$id}");
            }

            $employeeBankAccounts = $this->employeeBankAccountRepository->listByEmployeeId($id);
            $employeeContact = $this->employeeContactRepository->findByEmployeeId($id);
            $employeeJob = $this->employeeJobRepository->findByEmployeeId($id);
            $employeeDocuments = $this->employeeDocumentRepository->listByEmployeeId($id);

            if (!$employeeBankAccounts && !$employeeContact && !$employeeJob && !$employeeDocuments) {
                throw new \Exception("No related data found for this employee.");
            }

            $user = $this->userRepository->findById($employee->userId());
            if (!$user) {
                throw new \Exception("User associated with employee not found.");
            }
            $this->employeeBankAccountRepository->delete($id);
            $this->employeeDocumentRepository->delete($id);
            $this->employeeContactRepository->delete($id);
            $this->employeeJobRepository->delete($id);

            $employeeDeleted = $this->employeeRepository->delete($id);

            if ($employeeDeleted) {
                $this->userRepository->delete($user);
            } else {
                throw new \Exception("Failed to delete employee.");
            }

            DB::commit();

            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }
}
