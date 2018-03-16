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
	protected $metaTitle;
	protected $metaDescription;
	protected $createdAt;
	protected $createdBy;
	protected $updatedAt;
	protected $updatedBy;
    protected $featureImage;

    /**
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getUuid()
    {
        return $this->uuid;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @return string
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * @return string
     */
    public function getHidden()
    {
        return $this->hidden;
    }

    /**
     * @return string
     */
    public function getVisibility()
    {
        return $this->visibility;
    }

    /**
     * @return string
     */
    public function getParent()
    {
        return $this->parent;
    }

    /**
     * @return string
     */
    public function getMetaTitle()
    {
        return $this->metaTitle;
    }

    /**
     * @return string
     */
    public function getMetaDescription()
    {
        return $this->metaDescription;
    }

    /**
     * @return string
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @return string
     */
    public function getCreatedBy()
    {
        return $this->createdBy;
    }

    /**
     * @return string
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * @return string
     */
    public function getUpdatedBy()
    {
        return $this->updatedBy;
    }

    /**
     * @return string
     */
    public function getFeatureImage()
    {
        return $this->featureImage;
    }
}
