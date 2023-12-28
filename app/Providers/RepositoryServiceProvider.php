<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Interfaces\UserRepositoryInterface;
use App\Repositories\UserRepository;

use App\Interfaces\CompanyRepositoryInterface;
use App\Repositories\CompanyRepository;

use App\Interfaces\EmployeeRepositoryInterface;
use App\Repositories\EmployeeRepository;

use App\Interfaces\FreelancerRepositoryInterface;
use App\Repositories\FreelancerRepository;

use App\Interfaces\DepartmentRepositoryInterface;
use App\Interfaces\TaskRepositoryInterface;
use App\Repositories\DepartmentRepository;
use App\Repositories\TaskRepository;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
        $this->app->bind(CompanyRepositoryInterface::class, CompanyRepository::class);
        $this->app->bind(FreelancerRepositoryInterface::class, FreelancerRepository::class);
        $this->app->bind(EmployeeRepositoryInterface::class, EmployeeRepository::class);
        $this->app->bind(DepartmentRepositoryInterface::class, DepartmentRepository::class);
        $this->app->bind(TaskRepositoryInterface::class, TaskRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
