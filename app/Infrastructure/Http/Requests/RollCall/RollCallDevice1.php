<?php

namespace App\Infrastructure\Http\Requests\RollCall;

use Illuminate\Foundation\Http\FormRequest;

class RollCallDevice1 extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'fname' => 'nullable|string',
            'lname' => 'nullable|string',
            'kindvkh' => 'nullable|string',
        ];
    }
}
