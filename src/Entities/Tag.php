<?php

namespace GhostIO\Entities;

use GhostIO\Utils\JsonSerializableObject;

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

	function __construct($postData = null)
	{
		if ($postData) {
			foreach ($postData as $key => $value) {
				$key = str_replace(' ', '', ucwords(str_replace('_', ' ', $key)));
				$key = lcfirst($key);

				$this->{$key} = $value;
			}
		}
	}

}