<?php
namespace App\Infrastructure\Http\Requests\Position;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePositionRequest extends FormRequest
{
    public function authorize()
    {
        return true; // Check the authorization logic
    }

    public function rules()
    {
        return [
            'title' => 'nullable|string|max:255',
            'code' => 'nullable|string|max:255',
            'department_id' => 'nullable|integer|exists:departments,id',
            'description' => 'nullable|string',
        ];
    }
}
