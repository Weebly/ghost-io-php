<?php

namespace GhostIO;

use GhostIO\Utils\Collection;
use GhostIO\Entities\Post;

class GhostIO 
{
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


	/**
	 * Initializes the GhostIO instance
	 * @param string $url          The base url of the blog/api
	 * @param string $username     The username if the API user
	 * @param string $password     His password
	 * @param string $clientId     client id, read property comment
	 * @param string $clientSecret client secret, read property comment
	 */
	public function __construct($url, $username, $password, $clientId, $clientSecret)
	{
		// Initialize the guzzle client
		$this->httpClient = new \GuzzleHttp\Client([
			'base_uri' => $url . '/ghost/api/v0.1/'
		]);

		// initialize global properties
		$this->username = $username;
		$this->password = $password;
		$this->clientId = $clientId;
		$this->clientSecret = $clientSecret;

		// Authenticate this object
		$this->authenticate();
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
			throw new Exception('Unable to get access token.');
			
		}
		$this->token = $response_data->access_token;
	}


	/**
	 * Method to get all the posts of the account. Be carefull with this 
	 * because it will get all the records if you limit the request as "all"
	 * @return Collection  		All posts
	 */
	public function getAllPosts(array $fields = [])
	{
		// Here we prepare the guzzle request
		$options = [
			'headers' => [
				'Authorization' => 'Bearer ' . $this->token,
				'Content-Type' 	 => 'application/json'
			]
		];

		// filtering the fields we want to get
		if (!empty($fields)) {
			$options['query'] = [ 'fields' => $fields ];
		}

		// Do the /posts request
		$response = $this->httpClient->request('GET', 'posts', $options);

		// Make sure we are getting some posts
		$response_data = json_decode($response->getBody()->getContents());
		if (!$response_data->posts) {
			throw new Exception('Unable to get the posts.');
		}

		// Cleanup the data into objects
		$postCollection = new Collection();
		foreach ($response_data->posts as $postData) {
			$post = new Post($postData);
			$postCollection->add($post);
		}

		return $postCollection;
	}

	/**
	 * Method to get all the posts of the account. Be carefull with this 
	 * because it will get all the records if you limit the request as "all"
	 * @return Post  		The requested post
	 */
	public function getPostById($postId)
	{
		$response = $this->httpClient->request('GET', "posts/$postId", [
			'headers' => [
				'Authorization' => 'Bearer ' . $this->token,
				'Content-Type' 	 => 'application/json'
			]
		]);

		// Make sure we are getting some posts
		$response_data = json_decode($response->getBody()->getContents());
		if (!$response_data->posts) {
			throw new Exception('Unable to get the posts.');
		}

		$post = new Post($response_data->posts[0]);

		return $post;
	}

}
