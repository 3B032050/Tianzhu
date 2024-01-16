<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Web_hierarchy;
use App\Models\CourseCategory;

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
        View::composer('*', function ($view) {
            $webHierarchies = Web_hierarchy::all();
            $view->with('webHierarchies', $webHierarchies);

            $courseCategories = CourseCategory::orderBy('id', 'ASC')->get();
            $view->with('courseCategories', $courseCategories);
        });
    }
}
