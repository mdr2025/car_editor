<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }

    
}

use App\Models\Car;
use App\Policies\CarPolicy;

use App\Models\Customer;
use App\Policies\CustomerPolicy;

use App\Models\Employee;
use App\Policies\EmployeePolicy;

use App\Models\Job;
use App\Policies\JobPolicy;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        Car::class => CarPolicy::class,
        Customer::class => CustomerPolicy::class,
        Employee::class => EmployeePolicy::class,
    
        //تم التعدسل هنا 
         Car::class =>CarPolicy::class,


        
       
    ];
}

