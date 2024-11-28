<?php

namespace App\Providers;

use App\Models\Department;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        View::composer('frontend.layouts.footer', function ($view) {
            $departments = Department::all();
            $dynamicFooterData = [
                'departments' => $departments,
            ];

            $view->with('footerData', $dynamicFooterData);
        });
    }
}
