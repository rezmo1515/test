<?php

namespace App\Infrastructure\Http\Requests\Employee;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateEmployeeRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'first_name' => 'nullable|string|max:100',
            'last_name'  => 'nullable|string|max:100',
            'gender'     => 'nullable|in:male,female,other',
            'birth_date' => 'nullable|date',
            'national_id'=> 'nullable|string|size:10',
            'father_name'=> 'nullable|string|max:100',
            'birth_certificate_number' => 'nullable|string|size:10',
            'birth_place' => 'nullable|string|max:100',
            'marital_status' => 'nullable|in:married,unmarried',


            'create_portal_account'       => 'nullable|boolean',
            'portal_username'             => 'nullable|string|max:100',
            'portal_password'             => 'nullable|string|min:8|confirmed',
            'portal_password_confirmation'=> 'nullable|string|min:8',

            'contract_pdf' => 'nullable|file|mimes:pdf|max:2048',

            'contact' => 'sometimes|array',
            'contact.work_email'     => ['nullable','email', Rule::unique('employee_contacts','work_email')],
            'contact.personal_email' => 'nullable|email',
            'contact.mobile'         => 'nullable|string|max:20',
            'contact.phone'          => 'nullable|string|max:20',
            'contact.emergency_name' => 'nullable|string|max:100',
            'contact.emergency_phone'=> 'nullable|string|max:20',
            'contact.address'        => 'nullable|string|max:255',
            'contact.postal_code'    => 'nullable|string|max:20',

            'job' => 'sometimes|array',
            'job.department_id'      => 'nullable|exists:departments,id',
            'job.position_id'        => 'nullable|exists:positions,id',
            'job.manager_id'         => 'nullable|exists:employees,id',
            'job.hire_date'          => 'nullable|date',
            'job.employment_type'    => 'nullable|string|max:50',
            'job.employment_status'  => 'nullable|string|max:50',
            'job.personnel_code'     => 'nullable|string|max:50',
            'job.organization_unit_id'=> 'nullable|exists:departments,id',
            'job.shift_type'         => 'nullable|string|max:50',
            'job.start_date'         => 'nullable|date',

            'bank_accounts'                        => 'sometimes|array',
            'bank_accounts.*.bank_name'            => 'nullable|string|max:100',
            'bank_accounts.*.account_number'       => 'nullable|string|max:64',
            'bank_accounts.*.sheba_number'         => 'nullable|string|max:64',
            'bank_accounts.*.card_number'          => 'nullable|string|max:32',
            'bank_accounts.*.is_primary'           => 'sometimes|boolean',

            'documents'                 => 'sometimes|array',
            'documents.*.type'          => 'nullable|string|max:100',
            'documents.*.number'        => 'nullable|string|max:100',
            'documents.*.issued_at'     => 'nullable|date',
            'documents.*.expires_at'    => 'nullable|date|after_or_equal:documents.*.issued_at',
            'documents.*.file'          => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:4096',
            'documents.*.notes'         => 'nullable|string|max:500',

            'work_email'    => ['nullable','email', Rule::unique('employee_contacts','work_email')],
            'personal_email'=> 'nullable|email',
            'phone'         => 'nullable|string|max:20',
            'address'       => 'nullable|string|max:255',
            'department_id' => 'nullable|exists:departments,id',
            'position_id'   => 'nullable|exists:positions,id',
            'manager_id'    => 'nullable|exists:employees,id',
            'job_level'     => 'nullable|string|max:50',
            'location_id'   => 'nullable|exists:locations,id',
            'hire_date'     => 'nullable|date',
        ];
    }

    public function messages(): array
    {
        return [
            'contract_pdf.mimes' => 'The contract must be a PDF file.',
            'contract_pdf.max'   => 'The contract PDF cannot exceed 2MB.',
        ];
    }
}
