<?php

namespace Erjon\ManageResponse;

use Erjon\ManageResponse\Console\Commands\CreateLayout;
use Erjon\ManageResponse\Console\Commands\CreateToastrFile;
use Illuminate\Support\ServiceProvider;
class ManageResponseServiceProvider extends ServiceProvider
{
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                CreateLayout::class,
            ]);
        }
    }

    public function register()
    {
        $this->app->bind('manage_response', function () {
            return new ManageResponse;
        });
    }
}
