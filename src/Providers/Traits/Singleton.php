<?php

namespace GhostIO\Providers\Traits;

use GhostIO\Client;

/*
|--------------------------------------------------------------------------
| Singleton Provider Trait
|--------------------------------------------------------------------------
|
| This trait need to be added to all the provider classes so they work
| as singleton instances.
|
*/

trait Singleton
{
	protected static $instance;

	public $client;

	public static function getInstance(Client $client)
	{
		if (!static::$instance) {
            static::$instance = new static($client);
        }
        return static::$instance;
	}

	protected function __construct(Client $client)
	{
		$this->setClient($client);
	}

	public function setClient(Client $client)
	{
		$this->client = $client;
	}

}
