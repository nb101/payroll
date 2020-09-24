<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            'App\Contracts\FileExporter',
            'App\Helpers\CsvExporter'
        );

        $this->app->bind(
            'App\Contracts\TimeAhead',
            'App\Helpers\MonthsAhead'
        );
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
