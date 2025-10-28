<?php
namespace App\Infrastructure\Http\Requests\RolePermission;

use Illuminate\Foundation\Http\FormRequest;

class CreateRoleUserRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'employee_id' => 'required|int|exists:employees,id',
            'role_id' => 'required|int|exists:roles,id',
        ];
    }
}
