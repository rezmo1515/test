<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmployeeJob extends Model
{
    protected $table = 'employee_jobs';
    protected $fillable = [
        'employee_id',
        'personnel_code',
        'organization_unit_id',
        'department_id',
        'position_id',
        'manager_id',
        'location_id',
        'job_level',
        'employment_type',
        'employment_status',
        'start_date',
        'hire_date',
        'shift_type',
    ];

    protected $casts = [
        'start_date' => 'date',
        'hire_date'  => 'date',
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function position()
    {
        return $this->belongsTo(Position::class);
    }

    public function manager()
    {
        return $this->belongsTo(Employee::class, 'manager_id');
    }

    public function location()
    {
        return $this->belongsTo(Location::class);
    }
}
