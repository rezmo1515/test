<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'city',
        'province',
        'country',
        'address_line',
        'postal_code',
    ];

    /* Relationships */

    public function employees()
    {
        return $this->hasMany(Employee::class);
    }
}
