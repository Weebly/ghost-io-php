<?php

namespace GhostIO\Providers;

use GhostIO\Entities\Post;
use GhostIO\Utils\Collection;

class PostProvider extends AbstractProvider
{

	/**
	 * Method to get all the posts of the account. Be carefull with this
	 * because it will get all the records if you limit the request as "all"
	 * @return Collection  		All posts
	 */
	public function getAll(array $fields = [])
	{
		$options = [];

		// filtering the fields we want to get
		if (!empty($fields)) {
			$options['query'] = [ 'fields' => $fields ];
		}

		// Do the /posts request
		$response = $this->client->request('GET', 'posts', $options);

		// Make sure we are getting some posts
		$response_data = json_decode($response->getBody()->getContents());

		if (!isset($response_data->posts)) {
			throw new \Exception('Unable to get the posts.');
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
	public function getById($postId)
	{
		$response = $this->client->request('GET', "posts/$postId", []);

		// Make sure we are getting some posts
		$response_data = json_decode($response->getBody()->getContents());
		if (!isset($response_data->posts)) {
			throw new \Exception('Unable to get the posts.');
		}

		$post = new Post($response_data->posts[0]);

		return $post;
	}
}
