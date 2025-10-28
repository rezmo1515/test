<?php
namespace App\Infrastructure\Http\Requests\Position;

use Illuminate\Foundation\Http\FormRequest;

class ShowPositionRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => 'nullable|string|max:255',
            'code' => 'nullable|string|max:255',
            'department_id' => 'nullable|string|exists:department,id',
            'description' => 'nullable|string',
        ];
    }
}
