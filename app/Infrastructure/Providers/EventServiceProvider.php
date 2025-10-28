<?php
namespace App\Infrastructure\Providers;

use App\Domain\Department\Events\DepartmentCreated;
use App\Domain\Employee\Events\EmployeeCreated;
use App\Domain\User\Events\UserCreated;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

//use App\Domain\V1\Listeners\SendWelcomeEmailListener;
//use App\Domain\V1\Listeners\LogDepartmentCreationListener;
//use App\Domain\V1\Listeners\NotifyAdminListener;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        EmployeeCreated::class => [
//            SendWelcomeEmailListener::class,
//            NotifyAdminListener::class,
        ],
        UserCreated::class => [
//            SendWelcomeEmailListener::class,
        ],
        DepartmentCreated::class => [
//            SendWelcomeEmailListener::class,
//            LogDepartmentCreationListener::class,
//            NotifyAdminListener::class,
        ],
    ];

    public function boot()
    {
        parent::boot();
    }
}
