<?php

namespace GhostIO;

class Client
{
	/**
	 * Blog Base Uri
	 * @var string
	 */
	protected $baseUri;

	/**
	 * The username of the API user
	 * @var string
	 */
	protected $username;

	/**
	 * The API user password
	 * @var [type]
	 */
	protected $password;

	/**
	 * Client Id, usually you can use "ghost-frontend" if is hosted
	 * on their server as a XXX.ghost.ui page.
	 * @var string
	 */
	protected $clientId;

	/**
	 * Client secret. It can be found using the inspector
	 * on any page of the blog and looking at the script tags.
	 * @var string
	 */
	protected $clientSecret;

	/**
	 * The Guzzle client
	 * @var GuzzleHttp\Client
	 */
	protected $httpClient;

	/**
	 * API token for authentication
	 * @var string
	 */
	protected $token;

	function __construct($baseUri, $username, $password, $clientId, $clientSecret)
	{
		// initialize global properties
		$this->baseUri = $baseUri;
		$this->username = $username;
		$this->password = $password;
		$this->clientId = $clientId;
		$this->clientSecret = $clientSecret;

		$this->initializeHTTPClient();
	}

	/**
	 * Prepares the http client for out object
	 * @return void
	 */
	public function initializeHTTPClient()
	{
		// Initialize the guzzle client
		$this->httpClient = new \GuzzleHttp\Client([
			'base_uri' => $this->baseUri . '/ghost/api/v0.1/'
		]);

		// Authenticate this object
		$this->authenticate();
	}

	/**
	 * This verifies if we got a token at some point
	 * @return boolean true if we have a token
	 */
	public function isAuthenticated()
	{
		return $this->token != null;
	}

	/**
	 * Authentication method. Called on the constructor to get
	 * the "Bearer <token>" token string.
	 * @return void
	 */
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

		// Here we make sure we are getting the token
		$response_data = json_decode($response->getBody()->getContents());
		if (!$response_data->access_token) {
			throw new \Exception('Unable to get access token.');

		}
		$this->token = $response_data->access_token;
	}

	/**
	 * Sends an http request
	 * @param  string $method  HTTP method
	 * @param  string $route   the service to request
	 * @param  array  $options The options of the request
	 * @return Response        The http response
	 */
	public function request($method, $route, $options)
	{
		// Here we prepare the guzzle request
		$options['headers']['Authorization'] = 'Bearer ' . $this->getToken();
		$options['headers']['Content-Type'] = 'application/json';

		// Do a guzzle request
		return $this->httpClient->request($method, $route, $options);
	}

    /**
     * @return string
     */
    public function getToken()
    {
        return $this->token;
    }
}
