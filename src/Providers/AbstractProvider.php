<?php

namespace GhostIO\Providers;

use GhostIO\Client;

class AbstractProvider
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
		$this->client = $client;
	}

}
