<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeDevice1 extends Model
{
    use HasFactory;

    protected $table = 'employee_device_1';

    protected $fillable = [
        'number',
        'stid',
        'fname',
        'lname'
    ];

}
