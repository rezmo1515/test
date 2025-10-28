<?php
namespace App\Infrastructure\Http\Requests\Department;

use Illuminate\Foundation\Http\FormRequest;

class UpdateDepartmentRequest extends FormRequest
{
    public function authorize()
    {
        return true; // Check the authorization logic
    }

    public function rules()
    {
        return [
            'name' => 'nullable|string|max:255',
            'code' => 'nullable|string|max:255',
            'manager_id' => 'nullable|integer|exists:employees,id',
            'description' => 'nullable|string',
        ];
    }
}
