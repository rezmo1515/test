<?php

namespace App\Database\Eloquent;

use App\Domain\Employee\Entities\EmployeeBankAccount as Entity;
use App\Domain\Employee\Repositories\EmployeeBankAccountRepositoryInterface;
use App\Models\EmployeeBankAccount as Model;

class EloquentEmployeeBankAccountRepository implements EmployeeBankAccountRepositoryInterface
{
    public function add(Entity $a): Entity
    {
        $m = Model::updateOrCreate([
            'employee_id' => $a->employeeId(),
            'bank_name' => $a->bankName(),
            'account_number' => $a->accountNumber(),
            'sheba_number' => $a->shebaNumber(),
            'card_number' => $a->cardNumber(),
            'is_primary' => $a->isPrimary(),
        ]);
        return $this->map($m);
    }

    public function listByEmployeeId(int $employeeId): array
    {
        return Model::where('employee_id',$employeeId)->get()->toArray();
    }

    private function map(Model $m): Entity
    {
        return new Entity(
            id: $m->id,
            employeeId: $m->employee_id,
            bankName: $m->bank_name,
            accountNumber: $m->account_number,
            shebaNumber: $m->sheba_number,
            cardNumber: $m->card_number,
            isPrimary: (bool)$m->is_primary
        );
    }

    public function delete(int $employeeId): bool
    {
        $deletedCount = Model::where('employee_id', $employeeId)->delete();

        return $deletedCount > 0;
    }

}
