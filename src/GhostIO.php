<?php

namespace GhostIO;

class GhostIO {

	protected $clientId;
	protected $clientSecret;
	protected $apiUrl;

	protected $httpClient;

	public function __construct()
	{
		$this->httpClient = new GuzzleHttp\Client();
	}

	public function getPosts()
	{
		// This will get you the posts that are on ghost.io
		$res = $httpClient->request('GET', $this->apiUrl . 'posts');
		
		echo $res->getStatusCode();
		// "200"
		echo $res->getHeader('content-type');
		// 'application/json; charset=utf8'
		echo $res->getBody();
		// {"type":"User"...'
	}

}