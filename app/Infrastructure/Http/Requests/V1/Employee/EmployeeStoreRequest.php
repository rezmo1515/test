<?php

namespace App\Infrastructure\Http\Requests\V1\Employee;

use Illuminate\Foundation\Http\FormRequest;

class EmployeeStoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()->can('manage-staff');  // Check if the user has permission
    }

    public function rules(): array
    {
        return [
            'first_name' => 'required|string|max:100',
            'last_name' => 'required|string|max:100',
            'gender' => 'required|in:male,female,other',
            'birth_date' => 'nullable|date',
            'national_id' => 'required|string|size:10',  // Adjust as per your business rules
            'work_email' => 'nullable|email|unique:employees,work_email',  // Unique across employees
            'personal_email' => 'nullable|email',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:255',
            'department_id' => 'nullable|exists:departments,id',
            'position_id' => 'nullable|exists:positions,id',
            'manager_id' => 'nullable|exists:employees,id',
            'job_level' => 'nullable|string|max:50',
            'location_id' => 'nullable|exists:locations,id',
            'hire_date' => 'nullable|date',
            'create_portal_account' => 'required|boolean',
            'portal_username' => 'nullable|string|max:100',
            'portal_password' => 'nullable|string|min:8|confirmed',
            'contract_pdf' => 'nullable|file|mimes:pdf|max:2048',
        ];
    }

    public function messages(): array
    {
        return [
            'contract_pdf.mimes' => 'The contract must be a PDF file.',
            'contract_pdf.max' => 'The contract PDF cannot exceed 2MB.',
        ];
    }

}
