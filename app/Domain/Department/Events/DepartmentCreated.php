<?php
namespace App\Domain\Department\Events;

use App\Domain\Department\Entities\Department;
use Illuminate\Queue\SerializesModels;

class DepartmentCreated
{
    use SerializesModels;

    public Department $department;

    public function __construct(Department $department)
    {
        $this->department = $department;
    }
}
