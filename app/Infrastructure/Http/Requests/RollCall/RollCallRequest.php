<?php

namespace App\Infrastructure\Http\Requests\RollCall;

use Illuminate\Foundation\Http\FormRequest;

class RollCallRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'employee_id' => 'required|exists:employees,id',
            'entry'       => 'required|boolean',
            'type'        => 'required|in:normal, mission, vacation,remote_work',
            'status'      => 'required|in:waiting,accepted,rejected',
        ];
    }
}
