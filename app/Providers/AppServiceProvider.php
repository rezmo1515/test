<?php

namespace App\Providers;

use App\Database\Eloquent\EloquentUserRepository;
use App\Domain\V1\Employee\Repositories\EmployeeRepositoryInterface;
use App\Domain\V1\User\Repositories\UserRepositoryInterface;
use App\Database\Eloquent\EloquentEmployeeRepository;
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
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
