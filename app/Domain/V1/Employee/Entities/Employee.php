<?php
namespace App\Domain\V1\Employee\Entities;

use App\Domain\V1\Employee\ValueObjects\{FullName, Gender, NationalId, Email, Phone, Address};
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    private ?int $id;
    private FullName $name;
    private Gender $gender;
    private ?Carbon $birthDate;
    private NationalId $nationalId;
    private ?Email $email;
    private ?Email $personalEmail;
    private ?Phone $phone;
    private ?Address $address;
    private string $employeeCode;
    private ?int $departmentId;
    private ?int $positionId;
    private ?int $managerId;
    private ?string $jobLevel;
    private ?int $locationId;
    private ?Carbon $hireDate;
    private bool $profileCompleted = false;
    private ?int $userId = null;
    private string $contract_pdf;

    public function __construct(
        ?int $id,
        FullName $name,
        Gender $gender,
        ?Carbon $birthDate,
        NationalId $nationalId,
        ?Email $workEmail,
        ?Email $personalEmail,
        ?Phone $phone,
        ?Address $address,
        string $employeeCode,
        ?int $departmentId,
        ?int $positionId,
        ?int $managerId,
        ?string $jobLevel,
        ?int $locationId,
        ?Carbon $hireDate,
        bool $profileCompleted = false,
        ?int $userId = null,
        string $contract_pdf = null
    ) {
        $this->id = $id;
        $this->name = $name;
        $this->gender = $gender;
        $this->birthDate = $birthDate;
        $this->nationalId = $nationalId;
        $this->email = $workEmail;
        $this->personalEmail = $personalEmail;
        $this->phone = $phone;
        $this->address = $address;
        $this->employeeCode = $employeeCode;
        $this->departmentId = $departmentId;
        $this->positionId = $positionId;
        $this->managerId = $managerId;
        $this->jobLevel = $jobLevel;
        $this->locationId = $locationId;
        $this->hireDate = $hireDate;
        $this->profileCompleted = $profileCompleted;
        $this->userId = $userId;
        $this->contract_pdf = $contract_pdf;
    }

    // Getter methods
    public function id(): ?int { return $this->id; }
    public function name(): FullName { return $this->name; }
    public function gender(): Gender { return $this->gender; }
    public function birthDate(): ?Carbon { return $this->birthDate; }
    public function nationalId(): NationalId { return $this->nationalId; }
    public function workEmail(): ?Email { return $this->email; }
    public function personalEmail(): ?Email { return $this->personalEmail; }
    public function phone(): ?Phone { return $this->phone; }
    public function address(): ?Address { return $this->address; }
    public function employeeCode(): string { return $this->employeeCode; }
    public function departmentId(): ?int { return $this->departmentId; }
    public function positionId(): ?int { return $this->positionId; }
    public function managerId(): ?int { return $this->managerId; }
    public function jobLevel(): ?string { return $this->jobLevel; }
    public function locationId(): ?int { return $this->locationId; }
    public function hireDate(): ?Carbon { return $this->hireDate; }
    public function profileCompleted(): bool { return $this->profileCompleted; }
    public function getUserId(): ?int { return $this->userId; }
    public function contractPdf(): string { return $this->contract_pdf; }
}
