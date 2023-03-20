<?php

namespace Erjon\ManageResponse;

use Erjon\ManageResponse\Console\Commands\CreateLayout;
use Illuminate\Support\ServiceProvider;
class ManageResponseServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->loadTranslationsFrom(__DIR__.'/lang', 'manage-response');

        $this->mergeConfigFrom(__DIR__.'/config/toastr.php', 'toastr');

        if ($this->app->runningInConsole()) {
            $this->commands([
                CreateLayout::class,
            ]);

            $this->publishes([
                __DIR__.'/lang' => $this->app->langPath('vendor/manage-response'),
                __DIR__.'/config/toastr.php' => config_path('toastr.php')
            ], 'manage-response');
        }
    }

    public function register()
    {
        $this->app->bind('manage_response', function () {
            return new ManageResponse;
        });
    }
}
