<?php

/*
|--------------------------------------------------------------------------
| Dummy Classes
|--------------------------------------------------------------------------
|
| This classes will serve as helpers for the API response so we mock it
| and we dont actually go and send a request to the real server.
|
*/
include_once "tests/Mocks/ResponseDummy.php";
include_once "tests/Mocks/ResponseBodyDummy.php";


/*
|--------------------------------------------------------------------------
| Composer PS4 autoloader - App Classes
|--------------------------------------------------------------------------
|
| Load all the classes that live in the src folder.
|
*/
require_once "vendor/autoload.php";
