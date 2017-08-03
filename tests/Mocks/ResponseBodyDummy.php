<?php

namespace GhostIO\Tests\Mocks;

/*
|--------------------------------------------------------------------------
| Dummy Classes
|--------------------------------------------------------------------------
|
| This classes will serve as helpers for the API response so we mock it
| and we dont actually go and send a request to the real server.
|
*/

class ResponseBodyDummy
{
	private $contents;

	public function getContents()
	{
		return $this->contents;
	}

	public function setContents(array $contents)
	{
		$this->contents = json_encode($contents);
	}
}
