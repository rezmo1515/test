<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeviceRollcall1 extends Model
{
    use HasFactory;

    protected $table = 'device_1_rollcall';

    protected $fillable = [
        'stid',
        'station',
        'host',
        'kindvkh',
        'is_del',
        'valid',
        'event_time'
    ];

    public function employeeDevice1RollCall()
    {
        return $this->belongsTo(EmployeeDevice1::class, 'stid', 'stid');
    }

}
