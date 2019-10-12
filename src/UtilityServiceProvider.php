<?php

namespace Jakerw\Utility;

use Illuminate\Support\ServiceProvider;
use Jakerw\Utility\Commands\CreateSkeleton;

class UtilityServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        /*
         * Optional methods to load your package assets
         */
        // $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'utility');
        // $this->loadViewsFrom(__DIR__.'/../resources/views', 'utility');
        // $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
        // $this->loadRoutesFrom(__DIR__.'/routes.php');

        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../config/config.php' => config_path('utility.php'),
            ], 'config');

            // Publishing the views.
            /*$this->publishes([
                __DIR__.'/../resources/views' => resource_path('views/vendor/utility'),
            ], 'views');*/

            // Publishing assets.
            /*$this->publishes([
                __DIR__.'/../resources/assets' => public_path('vendor/utility'),
            ], 'assets');*/

            // Publishing the translation files.
            /*$this->publishes([
                __DIR__.'/../resources/lang' => resource_path('lang/vendor/utility'),
            ], 'lang');*/
            
            // Register Helper
            //$this->registerHelpers();
            // Registering package commands.
            $this->commands([
                CreateSkeleton::class,
            ]);
        }
    }

    /**
     * Register helpers file
     */
    // public function registerHelpers()
    // {
    //     $file = __DIR__.'/Helpers/Helpers.php';
    //     //dd( $file);
    //     // Load the helpers in app/Http/helpers.php
    //     if (file_exists( $file ))
    //     {
    //         //dd('file exists');
    //         require_once $file;
    //     }

        
    // }

    /**
     * Register the application services.
     */
    public function register()
    {
        // Automatically apply the package configuration
        $this->mergeConfigFrom(__DIR__.'/../config/config.php', 'utility');

        // Register the main class to use with the facade
        $this->app->singleton('utility', function () {
            return new Utility;
        });
    }
}
