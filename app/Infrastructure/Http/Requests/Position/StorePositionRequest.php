<?php
namespace App\Infrastructure\Http\Requests\Position;

use Illuminate\Foundation\Http\FormRequest;

class StorePositionRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'title' => 'required|string|max:255',
            'code' => 'required|string|max:255',
            'department_id' => 'required|integer|exists:departments,id',
            'description' => 'nullable|string',
        ];
    }
}
