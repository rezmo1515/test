<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmployeeBankAccount extends Model
{
    protected $table = 'employee_bank_accounts';
    protected $fillable = [
        'employee_id',
        'bank_name',
        'account_number',
        'card_number',
        'sheba_number',
        'is_primary',
    ];

    protected $casts = [
        'is_primary' => 'boolean',
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}
