<?php namespace Lahaxearnaud\LaravelPushbullet;

use Illuminate\Support\ServiceProvider;
use \Config as Config;

class LaravelPushbulletServiceProvider extends ServiceProvider
{

    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__ . '/../../config/config.php' => config_path('pushbullet.php'),
        ]);
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('pushbullet', function () {
            $apiKey = $this->app['config']->get('laravel-pushbullet::apiKey', null);

            return new LaravelPushbullet($apiKey);
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['pushbullet'];
    }

}
