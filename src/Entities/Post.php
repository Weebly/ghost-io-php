<?php

namespace GhostIO\Entities;

use GhostIO\Utils\JsonSerializableObject;

class Post extends JsonSerializableObject
{
	protected $id;
	protected $uuid;
	protected $title;
	protected $slug;
	protected $markdown;
	protected $html;
	protected $image;
	protected $featured;
	protected $page;
	protected $status;
	protected $locale;
	protected $metaTitle;
	protected $metaDescription;
	protected $createdAt;
	protected $createdBy;
	protected $updatedAt;
	protected $updatedBy;
	protected $publishedAt;
	protected $publishedBy;
	protected $author;
	protected $url;
	protected $language;
	protected $visibility;
	protected $featureImage;

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