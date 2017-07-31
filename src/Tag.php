<?php

namespace GhostIO;

use GhostIO\JsonSerializableObject;

/**
* A tag
*/
class Tag extends JsonSerializableObject
{
		
	protected $id;
	protected $uid;
	protected $name;
	protected $slug;
	protected $hidden;
	protected $parent;
	protected $image;
	protected $metaTitle;
	protected $metaDescription;
	protected $createdAt;
	protected $createdBy;
	protected $updatedAt;
	protected $updatedBy;

	function __construct()
	{
		# code...
	}

}