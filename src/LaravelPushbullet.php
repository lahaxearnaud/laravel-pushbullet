<?php namespace Lahaxearnaud\LaravelPushbullet;

use Illuminate\Support\Collection;
use PHPushbullet\PHPushbullet;

class LaravelPushbullet extends PHPushbullet {

    public function __construct($access_token = null)
    {
        parent::__construct($access_token, null, ['verify' => false]);
    }


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
