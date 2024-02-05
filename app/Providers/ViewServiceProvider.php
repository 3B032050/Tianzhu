<?php

namespace App\Providers;

use App\Models\CourseOverview;
use App\Models\Introduction;
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

            $introductions = Introduction::orderBy('id', 'ASC')->get();
            $view->with('introductions', $introductions);

            $courseCategories = CourseCategory::orderBy('id', 'ASC')->get();
            $view->with('courseCategories', $courseCategories);

            $courseOverview = CourseOverview::where('title','總覽')->first();
            $view->with('courseOverview', $courseOverview);
        });
    }
}
