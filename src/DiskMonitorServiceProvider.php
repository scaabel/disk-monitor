<?php

namespace Kenyalang\DiskMonitor;

use Illuminate\Support\ServiceProvider;
use Kenyalang\DiskMonitor\Console\RecordDiskMetricsCommand;

class DiskMonitorServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
//         $this->loadMigrationsFrom(__DIR__.'/../database/migrations');

        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/../config/config.php' => config_path('disk-monitor.php'),
            ], 'config');

             $this->commands([
                 RecordDiskMetricsCommand::class
             ]);

            if (! class_exists('CreateDiskMonitorEntryTable')) {
                $this->publishes([
                    __DIR__ . '/../database/migrations/create_disk_monitor_entry_table.php.stub' => database_path('migrations/' . date('Y_m_d_His', time()) . '_create_disk_monitor_entry_table.php'),
                ], 'migrations');
            }
        }
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        // Automatically apply the package configuration
        $this->mergeConfigFrom(__DIR__ . '/../config/config.php', 'disk-monitor');

        // Register the main class to use with the facade
        $this->app->singleton('laravel-disk-monitor', function () {
            return new DiskMonitor;
        });
    }
}
