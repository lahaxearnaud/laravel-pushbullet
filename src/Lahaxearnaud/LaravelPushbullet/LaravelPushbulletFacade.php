<?php namespace Lahaxearnaud\LaravelPushbullet;

use Illuminate\Support\Facades\Facade;

class LaravelPushbulletFacade extends Facade {

    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor() { return 'pushbullet'; }
}