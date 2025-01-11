<?php

namespace App\Providers;

use App\Models\Website;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\View;
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
        // Using Bootstrap Paginate
        Paginator::useBootstrapFive();
        Paginator::useBootstrapFour();

        // View share
        $application = Website::first();
        View::share('application', $application);
    }
}