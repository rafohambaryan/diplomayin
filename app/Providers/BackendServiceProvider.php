<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class BackendServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            "App\Repository\Backend\Interfaces\PostRepositoryInterface",
            "App\Repository\Backend\PostRepository"
        );
        $this->app->bind(
            "App\Repository\Backend\Interfaces\MainSlideRepositoryInterface",
            "App\Repository\Backend\MainSlideRepository"
        );
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
