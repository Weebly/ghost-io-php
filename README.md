Ghost IO Unofficial PHP library
===============================

This library is intended to help developer to use the Ghost.io API with their php code. 

Features
--------

* PSR-4 autoloading compliant structure
* Unit-Testing with PHPUnit
* Easy to use library


Instalation
-----

Right now is only on my personal repo <enrique/ghost-io-php> but the idea is that later we can serve it as a packagist library under the weebly name.

Make sure you're loading the composer libraries:

```
include_once "vendor/autoload.php";
```


Usage
-----

```
use GhostIO\GhostIO;

$ghost = new GhostIO(
	'https://your-blog.ghost.io',	// This is the base url for your blog
	'example@example.com',	// This is tne user email (username) of the user that will do the API requests
	'password',	// The user password
	'ghost-frontend',	// The client id
	'the-client-secret'	// The client secret
);

$res = $ghost->getAllPosts(); // retrieve all posts from the ghost server

```

Enjoy!