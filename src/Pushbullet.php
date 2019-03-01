<?php

namespace Lahaxearnaud\LaravelPushbullet;

use Illuminate\Support\Facades\Facade;
use Lahaxearnaud\LaravelPushbullet\Services\LaravelPushbullet;


/**
 * Class Pushbullet
 *
 * @method static LaravelPushbullet all()
 * @method static Device[] devices()
 * @method static LaravelPushbullet type(...$type)
 * @method static Device[] user()

 * @see LaravelPushbullet
 * @package Lahaxearnaud\LaravelPushbullet
 */
class Pushbullet extends Facade {

    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor() {

        return 'pushbullet';
    }
}