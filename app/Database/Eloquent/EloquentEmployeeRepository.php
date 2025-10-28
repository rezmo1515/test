<?php

namespace App\Database\Eloquent;

use App\Domain\Employee\Entities\Employee as Entity;
use App\Domain\Employee\Repositories\EmployeeRepositoryInterface;
use App\Models\Employee as Model;
use DateTimeImmutable;

class EloquentEmployeeRepository implements EmployeeRepositoryInterface
{
    public function save(Entity $e): Entity
    {
        $data = [
            'first_name' => $e->firstName(),
            'last_name'  => $e->lastName(),
            'gender'     => $e->gender(),
            'birth_date' => $e->birthDate()?->format('Y-m-d'),
            'national_id'=> $e->nationalId(),
            'father_name'=> $e->fatherName(),
            'birth_certificate_number'=> $e->birthCertificateNumber(),
            'birth_place'=> $e->birthPlace(),
            'marital_status'=> $e->maritalStatus(),
            'children_count'=> $e->childrenCount(),
            'user_id'    => $e->userId(),
            'profile_completed' => $e->profileCompleted(),
        ];

        $m = Model::updateOrCreate(['id'=>$e->id()], $data);
        return $this->map($m);
    }

    public function findById(int $id): ?Entity
    {
        $m = Model::find($id);
        return $m ? $this->map($m) : null;
    }

    public function delete(int $id): bool
    {
        $m = Model::find($id);
        return $m?->delete() ? true : false;
    }

    public function filter(array $filters): array
    {
        $q = Model::query()->with(['contact', 'job']);

        if (!empty($filters['first_name'])) {
            $q->where('first_name', 'like', '%'.$filters['first_name'].'%');
        }

        if (!empty($filters['personnel_code'])) {
            $q->whereHas('job', fn ($x) =>
            $x->where('personnel_code', 'like', '%'.$filters['personnel_code'].'%')
            );
        }

        if (!empty($filters['hire_date'])) {
            $q->whereHas('job', fn ($x) =>
            $x->whereDate('hire_date', $filters['hire_date'])
            );
        }

        if (!empty($filters['department_id'])) {
            $q->whereHas('job', fn ($x) =>
            $x->where('department_id', $filters['department_id'])
            );
        }

        if (!empty($filters['employment_status'])) {
            $q->whereHas('job', fn ($x) =>
            $x->where('employment_status', $filters['employment_status'])
            );
        }

        return $q->get()->toArray();
    }

    private function map(Model $m): Entity
    {
        return new Entity(
            id: $m->id,
            firstName: $m->first_name,
            lastName: $m->last_name,
            gender: $m->gender,
            birthDate: $this->toImmutable($m->birth_date),
            nationalId: $m->national_id,
            fatherName: $m->father_name,
            birthCertificateNumber: $m->birth_certificate_number,
            birthPlace: $m->birth_place,
            maritalStatus: $m->marital_status,
            childrenCount: (int)$m->children_count,
            userId: $m->user_id,
            profileCompleted: (bool)$m->profile_completed
        );
    }

    private function toImmutable(mixed $v): ?DateTimeImmutable
    {
        if (!$v) return null;
        if ($v instanceof \DateTimeImmutable) return $v;
        if ($v instanceof \DateTimeInterface) return DateTimeImmutable::createFromInterface($v);
        return new DateTimeImmutable((string)$v);
    }
}
