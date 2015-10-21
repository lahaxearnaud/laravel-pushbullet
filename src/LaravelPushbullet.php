<?php namespace Lahaxearnaud\LaravelPushbullet;

use PHPushbullet\PHPushbullet;

class LaravelPushbullet extends PHPushbullet {

    public function __construct($access_token = null)
    {
        parent::__construct($access_token);

        $this->api->setDefaultOption('verify', false);
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

    public function type()
    {
        foreach (func_get_args() as $type) {
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
}
