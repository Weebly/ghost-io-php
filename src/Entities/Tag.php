<?php

namespace GhostIO\Entities;

use GhostIO\Utils\JsonSerializableObject;

class Tag extends JsonSerializableObject
{
	protected $id;
	protected $uuid;
	protected $name;
	protected $description;
	protected $slug;
	protected $hidden;
	protected $visibility;
	protected $parent;
	protected $image;
	protected $metaTitle;
	protected $metaDescription;
	protected $createdAt;
	protected $createdBy;
	protected $updatedAt;
	protected $updatedBy;

    /**
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }
}
