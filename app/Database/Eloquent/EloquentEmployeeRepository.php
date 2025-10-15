<?php
namespace App\Database\Eloquent;

use App\Domain\V1\Employee\Entities\Employee;
use App\Domain\V1\Employee\Repositories\EmployeeRepositoryInterface;
use App\Domain\V1\Employee\Entities\Employee as EmployeeModel;
use App\Domain\V1\Employee\ValueObjects\{FullName, Gender, NationalId, Email, Phone, Address};
use Carbon\Carbon;

class EloquentEmployeeRepository implements EmployeeRepositoryInterface
{
    public function nextCode(): string
    {
        // Get the last employee record based on the 'id' column, or set it to 0 if no employees exist
        $last = EmployeeModel::max('id') ?? 0;

        // Format the employee code with the current year and the next incremental ID
        return sprintf('MH-%04d-%03d', now()->year, $last + 1);
    }

    public function save(Employee $e): Employee
    {
        // Prepare the data for the Employee model
        $data = [
            'first_name' => (string)$e->name()->firstName,
            'last_name'  => (string)$e->name()->lastName,
            'gender'     => $e->gender()->getValue(),
            'birth_date' => $e->birthDate() ?? null,
            'national_id' => (string)$e->nationalId(),
            'email'      => $e->workEmail() ? (string)$e->workEmail() : null,
            'personal_email' => $e->personalEmail() ? (string)$e->personalEmail() : null,
            'phone'      => $e->phone() ? (string)$e->phone() : null,
            'address'    => $e->address() ? (string)$e->address() : null,
            'employee_code' => $e->employeeCode(),
            'department_id' => $e->departmentId(),
            'position_id' => $e->positionId(),
            'manager_id' => $e->managerId(),
            'job_level'  => $e->jobLevel(),
            'location_id' => $e->locationId(),
            'hire_date'  => $e->hireDate() ?? null,
            'profile_completed' => $e->profileCompleted(),
            'user_id'    => $e->getUserId(),
            'contract_pdf' => $e->contractPdf(),
        ];

        // Update or create the employee record in the database
        $m = EmployeeModel::updateOrCreate(
            ['id' => $e->id()],
            $data
        );

        // Return the updated or created Employee entity with ID
        return new Employee(
            $m->id,
            new FullName($m->first_name, $m->last_name),
            new Gender($m->value),
            $m->birth_date ? Carbon::parse($m->birth_date) : null,
            new NationalId($m->national_id),
            new Email($m->email),
            $m->personal_email ? new Email($m->personal_email) : null,
            $m->phone ? new Phone($m->phone) : null,
            $m->address ? new Address($m->address) : null,
            $m->employee_code,
            $m->department_id,
            $m->position_id,
            $m->manager_id,
            $m->job_level,
            $m->location_id,
            $m->hire_date ? Carbon::parse($m->hire_date) : null,
            $m->profile_completed,
            $m->user_id,
            $m->contract_pdf
        );
    }

    public function getLastEmployee(): Employee
    {
        // Get the last employee (based on the 'id' field)
        $m = EmployeeModel::latest('id')->first();

        if (!$m) {
            throw new \Exception('No employee found');
        }

        // Return the Employee entity
        return new Employee(
            $m->id,
            new FullName($m->first_name, $m->last_name),
            new Gender($m->gender),
            $m->birth_date ? Carbon::parse($m->birth_date) : null,
            new NationalId($m->national_id),
            new Email($m->email),
            $m->personal_email ? new Email($m->personal_email) : null,
            $m->phone ? new Phone($m->phone) : null,
            $m->address ? new Address($m->address) : null,
            $m->employee_code,
            $m->department_id,
            $m->position_id,
            $m->manager_id,
            $m->job_level,
            $m->location_id,
            $m->hire_date ? Carbon::parse($m->hire_date) : null,
            $m->profile_completed,
            $m->user_id,
            $m->contract_pdf
        );
    }
}
