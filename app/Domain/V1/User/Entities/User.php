<?php
namespace App\Domain\V1\User\Entities;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Carbon\Carbon;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

    protected $fillable = ['username', 'email', 'password', 'active', 'lastLogin'];

    protected $hidden = ['password', 'remember_token'];

    protected $casts = [
        'lastLogin' => 'datetime',
    ];

    // Getter for username
    public function getUserName(): string
    {
        return $this->username;
    }

    // Getter for email - Return the Email object
    public function getEmail(): string
    {
        return $this->email;
    }

    // If you need to return the email as a string, you can create a method like this
    public function getEmailAsString(): string
    {
        return (string)$this->email; // This will call __toString() on the Email object
    }

    public function getPasswordHash(): string
    {
        return $this->password;
    }

    public function isActive(): bool
    {
        return $this->active;
    }

    public function getLastLogin(): Carbon
    {
        return $this->lastLogin ?? Carbon::now();
    }
}
