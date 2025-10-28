<?php

namespace App\Infrastructure\Http\Requests\Employee;

use Illuminate\Foundation\Http\FormRequest;

class ShowEmployeeRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'first_name'         => 'nullable|string|max:255',
            'personnel_code'     => 'nullable|string|max:255',
            'hire_date'          => 'nullable|date',
            'department_id'      => 'nullable|integer|exists:departments,id',
            'employment_status'  => 'nullable|string|max:50',
        ];
    }
}
