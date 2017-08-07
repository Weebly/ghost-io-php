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

Available Client Methods
------------------------

The following list shows what methods are available and the route that they represent on the ghost.io API:

| Method                            | API service   		| Description                                                                                                     |
| --------------------------------- | --------------------- | --------------------------------------------------------------------------------------------------------------- |
| $ghost->getAllPosts($fields = []) | /posts        		| Get a collection with all the posts of the blog. Some filters apply.                                            |
| $ghost->getPostById($postId)      | /posts:id     		| This will find one specific post by the ID.                                                                     |
| $ghost->getPostBySlug($slug) 		| /posts:slug   		| This will find one specific post by the slug.                                                                   |
| $ghost->getAllTags($fields = []) 	| /tags         		| Get a collection with all the tags (categories) that are defined for this blog of the blog. Some filters apply. |
| $ghost->getTagById($tagId)        | /tags:id      		| This will find one specific tag by the ID.                                                                      |
| $ghost->getTagBySlug($slug) 		| /tags:slug    		| This will find one specific tag by the slug.                                                                    |
| $ghost->getAllUsers($fields = []) | /users        		| Get a collection with all the users of the blog. Some filters apply.                                            |
| $ghost->getUserById($userId) 		| /users:id     		| This will find one specific user by the ID.                                                                     |
| $ghost->getUserBySlug($slug)      | /users:slug   		| This will find one specific user by the slug.                                                                   |
| $ghost->getUserByEmail($email)    | /users/email:email   	| This will find one specific user by his email address.                                                          |


Documentation
-------------

For more documentation, check the ghost.io API docs here: [GhostIO API Docs](https://api.ghost.org).

Enjoy!
