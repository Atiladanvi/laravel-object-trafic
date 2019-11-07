<?php

namespace Atiladanvi\LaravelObjectTrafic;

use Illuminate\Support\ServiceProvider;

/**
 * Class LaravelObjectTraficServiceProvider
 * @package Atiladanvi\LaravelObjectTrafic
 */
class LaravelObjectTraficServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        /*
         * Optional methods to load your package assets
         */
        // $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'laravel-object-trafic');
        // $this->loadViewsFrom(__DIR__.'/../resources/views', 'laravel-object-trafic');
        // $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
        $this->loadRoutesFrom(__DIR__.'/../routes/api.php');

        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../config/config.php' => config_path('laravel-object-trafic.php'),
            ], 'laravel-object-trafic/config');

            // Publishing the views.
            /*$this->publishes([
                __DIR__.'/../resources/views' => resource_path('views/vendor/laravel-object-trafic'),
            ], 'views');*/

            // Publishing assets.
            /*$this->publishes([
                __DIR__.'/../resources/assets' => public_path('vendor/laravel-object-trafic'),
            ], 'assets');*/

            // Publishing the translation files.
            /*$this->publishes([
                __DIR__.'/../resources/lang' => resource_path('lang/vendor/laravel-object-trafic'),
            ], 'lang');*/

            // Registering package commands.
            // $this->commands([]);
        }
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        // Automatically apply the package configuration
        $this->mergeConfigFrom(__DIR__.'/../config/config.php', 'laravel-object-trafic');

        // Register the main class to use with the facade
        /*$this->app->singleton('laravel-object-trafic', function () {
            return new LaravelObjectTrafic;
        });*/
    }
}
