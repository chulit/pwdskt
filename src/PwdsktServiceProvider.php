<?php

namespace Diskominfotik\Pwdskt;

use Diskominfotik\Pwdskt\Console\GeneratePwdskt;
use Diskominfotik\Pwdskt\Console\InstallPwdskt;
use Illuminate\Support\ServiceProvider;

class PwdsktServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../config/config.php' => config_path('pwdskt.php'),
            ], 'config');

            // Registering package commands.
            $this->commands([
                InstallPwdskt::class,
                GeneratePwdskt::class,
            ]);
        }
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        // Automatically apply the package configuration
        $this->mergeConfigFrom(__DIR__.'/../config/config.php', 'pwdskt');
    }
}
