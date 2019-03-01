<?php

namespace Lahaxearnaud\LaravelPushbullet\Services;

use Illuminate\Support\Collection;
use PHPushbullet\Connection;
use PHPushbullet\Device;
use PHPushbullet\PHPushbullet;

/**
 * Class LaravelPushbullet
 * @package Lahaxearnaud\LaravelPushbullet\Services
 */
class LaravelPushbullet extends PHPushbullet {

    /**
     * LaravelPushbullet constructor.
     * @param string $access_token
     * @param Connection|null $connection
     * @param array $config
     * @throws \Exception
     */
    public function __construct($access_token = null, Connection $connection =  null, array $config = [])
    {
        parent::__construct($access_token, $connection, $config);
    }

    /**
     * @return LaravelPushbullet
     */
    public function all()
    {
        $devices = $this->devices();
        foreach ($devices as $device) {
            if($device->active) {
                $this->device($device->iden);
            }
        }

        return $this;
    }

    /**
     * @return Device[]
     */
    public function device()
    {
        if (func_get_arg(0) instanceof Collection) {
            $args = func_get_arg(0)->toArray();
        } elseif (is_array(func_get_arg(0))) {
            $args = func_get_arg(0);
        } else {
            $args = func_get_args();
        }

        return call_user_func_array(['parent', 'device'], $args);
    }

    /**
     * @return $this
     * @throws \Exception
     */
    public function type()
    {
        if (func_get_arg(0) instanceof Collection || is_array(func_get_arg(0))) {
            $args = func_get_arg(0);
        } else {
            $args = func_get_args();
        }

        foreach ($args as $type) {
            $devices = $this->devices();
            foreach ($devices as $device) {
                if(strcasecmp($device->type, $type) === 0 && $device->active) {
                    $this->device($device->iden);
                }
            }
        }

        if (count($this->devices) === 0) {
            throw new \Exception("No devices for type " . $type);
        }

        return $this;
    }

    /**
     * @return Device[]
     */
    public function user()
    {
        if (func_get_arg(0) instanceof Collection) {
            $args = func_get_arg(0)->toArray();
        } elseif (is_array(func_get_arg(0))) {
            $args = func_get_arg(0);
        } else {
            $args = func_get_args();
        }

        return call_user_func_array(['parent', 'user'], $args);
    }
}
