Ghost IO Unofficial PHP library
===============================

This library is intended to help developer to use the Ghost.io API with their php code.

Features
--------

* PSR-4 autoloading compliant structure
* Unit-Testing with PHPUnit
* Easy to use library


Installation
------------

Right now is only on my personal repo <enrique/ghost-io-php> but the idea is that later we can serve it as a packagist library under the weebly name. So to add this right now to the project using composer we can do the following on out composer.json file:

```json
"repositories": [
  {
    "url": "https://github.intern.weebly.net/enrique/ghost-io-php",
    "type": "git"
  }
],
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

Usage
-----

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
