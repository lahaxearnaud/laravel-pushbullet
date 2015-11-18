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
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('pushbullet', function () {
            $apiKey = $this->app['config']->get('services.pushbullet.apiKey', null);

            if (!$apiKey) {
                $apiKey = $this->app['config']->get('pushbullet.apiKey', null);
            }

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
