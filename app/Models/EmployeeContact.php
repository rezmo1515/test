<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmployeeContact extends Model
{
    protected $table = 'employee_contacts';
    protected $fillable = [
        'employee_id',
        'mobile',
        'emergency_phone',
        'work_email',
        'personal_email',
        'address',
        'postal_code',
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}
