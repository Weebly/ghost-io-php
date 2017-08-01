<?php

namespace GhostIO;

class GhostIO 
{

	protected $username;
	protected $password;
	protected $clientId;
	protected $clientSecret;

	protected $httpClient;

	protected $token;

	public function __construct($url, $username, $password, $clientId, $clientSecret)
	{
		$this->httpClient = new \GuzzleHttp\Client([
			'base_uri' => $url . '/ghost/api/v0.1/'
		]);

		// initialize global properties
		$this->username = $username;
		$this->password = $password;
		$this->clientId = $clientId;
		$this->clientSecret = $clientSecret;

		$this->authenticate();
	}

	protected function authenticate()
	{
		$response = $this->httpClient->request('POST', 'authentication/token', [
			'form_params' => [
				'grant_type' 	=> 'password',
				'username' 		=> $this->username,
				'password' 		=> $this->password,
				'client_id' 	=> $this->clientId,
				'client_secret' => $this->clientSecret
			]
		]);

		$response_data = json_decode($response->getBody()->getContents());
		if (!$response_data->access_token) {
			throw new Exception('Unable to get access token.');
			
		}
		$this->token = $response_data->access_token;
	}


	public function getAllPosts()
	{

		$response = $this->httpClient->request('GET', 'posts', [
			'headers' => [
				'Authorization' => 'Bearer ' . $this->token,
				'Content-Type' 	 => 'application/json'
			],
			'query' => [
				'fields' => "title,url"
			]
		]);

		$response_data = json_decode($response->getBody()->getContents());
		if (!$response_data->posts) {
			throw new Exception('Unable to get the posts.');
			
		}
		return $response_data->posts;
	}


}