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
        $models = [
            'Post', 'MainSlide', 'Order', 'Subheading', 'SubheadingMany','Present'
        ];
        foreach ($models as $model) {
            $this->app->bind(
                "App\Repository\Backend\Interfaces\\{$model}RepositoryInterface",
                "App\Repository\Backend\\{$model}Repository"
            );
        }
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
