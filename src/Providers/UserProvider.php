<?php

namespace GhostIO\Providers;

use GhostIO\Entities\User;
use GhostIO\Utils\Collection;
use GhostIO\Providers\Traits\Singleton;

class UserProvider
{
	use Singleton;

	/**
	 * Method to get all the users of the account.
	 * @return Collection  		All users
	 */
	public function getAll(array $fields = [])
	{
		$options = [];

		// filtering the fields we want to get
		if (!empty($fields)) {
			$options['query'] = [ 'fields' => $fields ];
		}

		// Do the /users request
		$response = $this->client->request('GET', 'users', $options);

		// Make sure we are getting some users
		$response_data = json_decode($response->getBody()->getContents());
		if (!isset($response_data->users)) {
			throw new \Exception('Unable to get the users.');
		}

		// Cleanup the data into objects
		$userCollection = new Collection();
		foreach ($response_data->users as $userData) {
			$user = new User($userData);
			$userCollection->add($user);
		}

		return $userCollection;
	}

	/**
	 * Method to get all the users of the account.
	 * @return User  		The requested user
	 */
	public function getById($userId)
	{
		$response = $this->client->request('GET', "users/$userId", []);

		// Make sure we are getting some users
		$response_data = json_decode($response->getBody()->getContents());
		if (!isset($response_data->users)) {
			throw new \Exception('Unable to get the users.');
		}

		$user = new User($response_data->users[0]);

		return $user;
	}
}
