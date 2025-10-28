<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmployeeDocument extends Model
{
    protected $table = 'employee_documents';
    protected $fillable = [
        'employee_id',
        'type',
        'description',
        'file_path',
        'description'
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}
