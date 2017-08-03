<?php

namespace GhostIO;

use GhostIO\Providers\PostProvider;
use GhostIO\Providers\TagProvider;

class GhostIO
{
	/**
	 * The client
	 * @var GhostIO\Client
	 */
	protected $client;

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
		$this->client = new Client($url, $username, $password, $clientId, $clientSecret);
	}

	/**
	 * Method to get all the posts of the account. Be carefull with this
	 * because it will get all the records if you limit the request as "all"
	 * @return Collection  		All posts
	 */
	public function getAllPosts(array $fields = [])
	{
		$provider = PostProvider::getInstance($this->client);
		return $provider->getAll($fields);
	}

	/**
	 * Method to get a post by the id.
	 * @return Post  		The requested post
	 */
	public function getPostById($postId)
	{
		$provider = PostProvider::getInstance($this->client);
		return $provider->getById($postId);
	}

	/**
	 * Method to get all the Tags of the account.
	 * @return Collection  		All tags
	 */
	public function getAllTags(array $fields = [])
	{
		$provider = TagProvider::getInstance($this->client);
		return $provider->getAll($fields);
	}

	/**
	 * Method to get a Tag by the id.
	 * @return Tag  		The requested tag
	 */
	public function getTagById($tagId)
	{
		$provider = TagProvider::getInstance($this->client);
		return $provider->getById($tagId);
	}

}
