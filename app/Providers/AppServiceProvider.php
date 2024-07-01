<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Company;
use App\Models\Category;

class AppServiceProvider extends ServiceProvider
{
    public function boot()
    {
        view()->composer(['jobs.index', 'jobs.create', 'jobs.edit'], function ($view) {
            $view->with('companies', Company::all());
            $view->with('categories', Category::all());
        });
    }

    public function register()
    {
        //
    }
}
