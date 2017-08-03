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

class ResponseDummy
{
	private $body;

	public function getBody()
	{
		return $this->body;
	}

	public function setResponseBody(array $body)
	{
		$responseBody = new ResponseBodyDummy();
		$responseBody->setContents($body);
		$this->body = $responseBody;
	}
}
