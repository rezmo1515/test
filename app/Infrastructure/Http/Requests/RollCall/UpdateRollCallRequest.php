<?php

namespace App\Infrastructure\Http\Requests\RollCall;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRollCallRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'employee_id' => 'nullable|exists:employees,id',
            'entry'       => 'nullable|boolean',
            'type'        => 'nullable|in:normal, mission, vacation,remote_work',
            'status'      => 'nullable|in:waiting,accepted,rejected',
        ];
    }
}
