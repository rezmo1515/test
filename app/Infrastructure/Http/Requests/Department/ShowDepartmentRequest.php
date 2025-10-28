<?php
namespace App\Infrastructure\Http\Requests\Department;

use Illuminate\Foundation\Http\FormRequest;

class ShowDepartmentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'nullable|string|max:255',
            'code' => 'nullable|string|max:255',
            'manager_id' => 'nullable|string|exists:employees,id',
            'description' => 'nullable|string',
        ];
    }
}
