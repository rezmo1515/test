<?php

namespace App\Infrastructure\Providers;

use App\Database\Eloquent\EloquentDepartmentRepository;
use App\Database\Eloquent\EloquentEmployeeBankAccountRepository;
use App\Database\Eloquent\EloquentEmployeeContactRepository;
use App\Database\Eloquent\EloquentEmployeeDocumentRepository;
use App\Database\Eloquent\EloquentEmployeeJobRepository;
use App\Database\Eloquent\EloquentEmployeeRepository;
use App\Database\Eloquent\EloquentPositionRepository;
use App\Database\Eloquent\EloquentUserRepository;
use App\Domain\Department\Repositories\DepartmentRepositoryInterface;
use App\Domain\Employee\Repositories\EmployeeBankAccountRepositoryInterface;
use App\Domain\Employee\Repositories\EmployeeContactRepositoryInterface;
use App\Domain\Employee\Repositories\EmployeeDocumentRepositoryInterface;
use App\Domain\Employee\Repositories\EmployeeJobRepositoryInterface;
use App\Domain\Employee\Repositories\EmployeeRepositoryInterface;
use App\Domain\Position\Repositories\PositionRepositoryInterface;
use App\Domain\User\Repositories\UserRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(EmployeeRepositoryInterface::class, EloquentEmployeeRepository::class);
        $this->app->bind(UserRepositoryInterface::class, EloquentUserRepository::class);
        $this->app->bind(DepartmentRepositoryInterface::class, EloquentDepartmentRepository::class);
        $this->app->bind(PositionRepositoryInterface::class, EloquentPositionRepository::class);
        $this->app->bind(EmployeeContactRepositoryInterface::class, EloquentEmployeeContactRepository::class);
        $this->app->bind(EmployeeJobRepositoryInterface::class, EloquentEmployeeJobRepository::class);
        $this->app->bind(EmployeeBankAccountRepositoryInterface::class, EloquentEmployeeBankAccountRepository::class);
        $this->app->bind(EmployeeDocumentRepositoryInterface::class, EloquentEmployeeDocumentRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
