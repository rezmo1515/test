<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Employee extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'employees';
    protected $primaryKey = 'id';

    protected $fillable = [
        'first_name',
        'last_name',
        'father_name',
        'national_id',
        'birth_certificate_number',
        'birth_date',
        'birth_place',
        'marital_status',
        'children_count',
        'gender',
        'user_id',
        'profile_completed',
    ];

    protected $casts = [
        'birth_date' => 'date',
        'profile_completed' => 'boolean',
        'children_count' => 'integer',
    ];

    /** ----------------------------
     * 🔗 Relationships
     * -----------------------------*/
    public function contact()
    {
        return $this->hasOne(EmployeeContact::class);
    }

    public function job()
    {
        return $this->hasOne(EmployeeJob::class);
    }

    public function bankAccounts()
    {
        return $this->hasMany(EmployeeBankAccount::class);
    }

    public function documents()
    {
        return $this->hasMany(EmployeeDocument::class);
    }

    public function manager()
    {
        return $this->belongsTo(self::class, 'manager_id');
    }

    public function directReports()
    {
        return $this->hasMany(self::class, 'manager_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
