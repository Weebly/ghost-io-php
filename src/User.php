<?php

namespace GhostIO;

use GhostIO\JsonSerializableObject;

/**
* Class that contains the values of a User
*/
class User extends JsonSerializableObject
{
	protected $id;
	protected $uuid;
	protected $accesibility;
	protected $bio;
	protected $cover;
	protected $createdAt;
	protected $createdBy;
	protected $image;
	protected $locale;
	protected $lastLogin;
	protected $location;
	protected $metaTitle;
	protected $metaDescription;
	protected $name;
	protected $slug;
	protected $tour;
	protected $updatedAt;
	protected $updatedBy;
	protected $website;

	function __construct()
	{
		# code...
	}

}