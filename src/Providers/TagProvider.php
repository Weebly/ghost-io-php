<?php

namespace GhostIO\Providers;

use GhostIO\Entities\Tag;
use GhostIO\Utils\Collection;

class TagProvider extends AbstractProvider
{

	/**
	 * Method to get all the tags of the account.
	 * @return Collection  		All tags
	 */
	public function getAll(array $fields = [])
	{
		$options = [];

		// filtering the fields we want to get
		if (!empty($fields)) {
			$options['query'] = [ 'fields' => $fields ];
		}

		// Do the /tags request
		$response = $this->client->request('GET', 'tags', $options);

		// Make sure we are getting some tags
		$response_data = json_decode($response->getBody()->getContents());
		if (!$response_data->tags) {
			throw new \Exception('Unable to get the tags.');
		}

		// Cleanup the data into objects
		$tagCollection = new Collection();
		foreach ($response_data->tags as $tagData) {
			$tag = new Tag($tagData);
			$tagCollection->add($tag);
		}

		return $tagCollection;
	}

	/**
	 * Method to get all the tags of the account.
	 * @return Tag  		The requested tag
	 */
	public function getById($tagId)
	{
		$response = $this->client->request('GET', "tags/$tagId", []);

		// Make sure we are getting some tags
		$response_data = json_decode($response->getBody()->getContents());
		if (!$response_data->tags) {
			throw new \Exception('Unable to get the tags.');
		}

		$tag = new Tag($response_data->tags[0]);

		return $tag;
	}
}
