<?php

namespace GhostIO;

use GhostIO\JsonSerializableObject;

/**
* Class that contains the values of a Post
*/
class Post extends JsonSerializableObject
{
	protected $id;
	protected $uid;
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

	function __construct()
	{
		# code...
	}

}