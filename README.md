Ghost IO Unofficial PHP library
===============================

[![CircleCI](https://img.shields.io/circleci/project/github/weebly/ghost-io-php.svg)]()
[![MadeBy](https://img.shields.io/badge/made%20by-weebly-2f8be9.svg)]()


This library is intended to help developer to use the Ghost.io API with their php code.

## Features

* PSR-4 autoloading compliant structure
* Unit-Testing with PHPUnit
* Easy to use library


## Installation

We use packagist to serve this library so is easier to include to any of your projects. Make sure you have composer available in your PATH. To do this you can run the following command in the terminal:

```shell
composer require weebly/ghost-io-php
```

For the most recent dev version:

```json
"require": {
  "weebly/ghost-io-php": "master@dev"
},
```

Install or update your composer dependencies:

```shell
composer install
```

As a final check you could review your vendor library to see if you have a weeblu/ghost-io-php folder created.
Now you're ready to use this on you're code.

## Usage

```php
use GhostIO\GhostIO;

$ghost = new GhostIO(
	'https://your-blog.ghost.io',	// This is the base url for your blog
	'example@example.com',		// email (username) of the user that will do the API requests
	'password',			// The user password
	'ghost-frontend',		// The client id
	'the-client-secret'		// The client secret
);

$res = $ghost->getAllPosts(); // retrieve all posts from the ghost server

```

## Available Client Methods

The following list shows what methods are available and the route that they represent on the ghost.io API:

| Method                            | API service   		| Description                                                          |
| --------------------------------- | --------------------- | -------------------------------------------------------------------- |
| <pre>$ghost->getAllPosts($fields = [])</pre> | /posts        		| Get a collection with all the posts of the blog.Some filters apply.  |
| <pre>$ghost->getPostById($postId)</pre>      | /posts:id     		| This will find one specific post by the ID.                          |
| <pre>$ghost->getPostBySlug($slug)</pre> 		| /posts:slug   		| This will find one specific post by the slug.                        |
| <pre>$ghost->getAllTags($fields = [])</pre> 	| /tags         		| Get a collection with all the tags (categories).                     |
| <pre>$ghost->getTagById($tagId)</pre>        | /tags:id      		| This will find one specific tag by the ID.                           |
| <pre>$ghost->getTagBySlug($slug)</pre> 		| /tags:slug    		| This will find one specific tag by the slug.                         |
| <pre>$ghost->getAllUsers($fields = [])</pre> | /users        		| Get a collection with all the users of the blog. Some filters apply. |
| <pre>$ghost->getUserById($userId)</pre> 		| /users:id     		| This will find one specific user by the ID.                          |
| <pre>$ghost->getUserBySlug($slug)</pre>      | /users:slug   		| This will find one specific user by the slug.                        |
| <pre>$ghost->getUserByEmail($email)</pre>    | /users/email:email   	| This will find one specific user by his email address.               |


## Contributing

Please read [CONTRIBUTING.md](CONTRIBUTING.md) for details on our code of conduct, and the process for submitting pull requests to us.

## Documentation

For more documentation, check the ghost.io API docs here: [GhostIO API Docs](https://api.ghost.org).

Enjoy!
