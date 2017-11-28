<?php

namespace GhostIO;

use GhostIO\Providers\PostProvider;
use GhostIO\Providers\TagProvider;
use GhostIO\Providers\UserProvider;

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
	 * @param integer $postId 	The post id
	 * @return Post  			The requested post
	 */
	public function getPostById($postId)
	{
		$provider = PostProvider::getInstance($this->client);
		return $provider->getById($postId);
	}

	/**
	 * Gets the post object by the slug
	 * @param  string $slug 	The post slug
	 * @return Post       		The post instance
	 */
	public function getPostBySlug($slug)
	{
		$provider = PostProvider::getInstance($this->client);
		return $provider->getBySlug($slug);
	}

	/**
	 * Method to get all the Tags of the account.
	 * @return Collection  		All tags
	 */
	public function getAllTags(array $fields = [], $limit = 15)
	{
		$provider = TagProvider::getInstance($this->client);
		return $provider->getAll($fields, $limit);
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

	/**
	 * Gets the tag object by the slug
	 * @param  string $slug 	The tag slug
	 * @return Tag       		The tag instance
	 */
	public function getTagBySlug($slug)
	{
		$provider = TagProvider::getInstance($this->client);
		return $provider->getBySlug($slug);
	}

	/**
	 * Method to get all the Users of the account.
	 * @return Collection  		All users
	 */
	public function getAllUsers(array $fields = [])
	{
		$provider = UserProvider::getInstance($this->client);
		return $provider->getAll($fields);
	}

	/**
	 * Method to get a User by the id.
	 * @return User  		The requested user
	 */
	public function getUserById($userId)
	{
		$provider = UserProvider::getInstance($this->client);
		return $provider->getById($userId);
	}

	/**
	 * Gets the user object by the slug
	 * @param  string $slug 	The user slug
	 * @return User       		The user instance
	 */
	public function getUserBySlug($slug)
	{
		$provider = UserProvider::getInstance($this->client);
		return $provider->getBySlug($slug);
	}

	/**
	 * Gets the user object by their email address
	 * @param  string $email 	The user's email
	 * @return User       		The user instance
	 */
	public function getUserByEmail($email)
	{
		$provider = UserProvider::getInstance($this->client);
		return $provider->getByEmail($email);
	}
}
