<?php namespace Lahaxearnaud\LaravelPushbullet;

use PHPushbullet\PHPushbullet;

class LaravelPushbullet extends PHPushbullet {

	public function __construct($access_token = null)
    {
		parent::__construct($access_token);

		$this->api->setDefaultOption('verify', false);
	}
}