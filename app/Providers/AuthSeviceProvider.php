<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;
use Illuminate\Auth\Access\Response;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // Register any application-specific services here if needed
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $this->registerPolicies();

        // Define Gates and Policies for Category model
        Gate::define('view-category', function ($user) {
            return $user->isAdmin() || $user->isEditor()
                ? Response::allow()
                : Response::deny('You are not authorized to view categories.');
        });
        Gate::resource('category', 'App\Policies\CategoryPolicy');

        // Define Gates and Policies for Company model
        Gate::define('view-company', function ($user) {
            return $user->isAdmin() || $user->isEditor()
                ? Response::allow()
                : Response::deny('You are not authorized to view companies.');
        });
        Gate::resource('company', 'App\Policies\CompanyPolicy');

        // Define Gates and Policies for Job model
        Gate::define('view-job', function ($user) {
            return $user->isAdmin() || $user->isEditor()
                ? Response::allow()
                : Response::deny('You are not authorized to view jobs.');
        });
        Gate::resource('job', 'App\Policies\JobPolicy');

        // You can register more gates and policies for other models here
        // Example:
        /*
        Gate::define('view-user', function ($user) {
            return $user->isAdmin()
                ? Response::allow()
                : Response::deny('You are not authorized to view users.');
        });
        Gate::resource('user', 'App\Policies\UserPolicy');
        */

        // Register more gates and policies for other models as needed
    }
}
