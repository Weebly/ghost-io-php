<?php

namespace GhostIO\Entities;

use GhostIO\Utils\Collection;
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


	/**
     * Constructor. We want to make sure that when we send data to it, it will
     * add those values to the property of the object.
     * @param array $data 	Data for the object
     */
    function __construct($data = null)
	{
		if ($data) {
			foreach ($data as $key => $value) {

				// Here we will create the tags collection of all the
				// tags that are related to this post
				if ($key == 'tags') {

					// Cleanup the data into objects
					$tagCollection = new Collection();
					foreach ($value as $tagData) {
						$tag = new Tag($tagData);
						$tagCollection->add($tag);
					}

					$this->tags = $tagCollection;
					continue;
				}

				$key = str_replace(' ', '', ucwords(str_replace('_', ' ', $key)));
				$key = lcfirst($key);

				$this->{$key} = $value;
			}
		}
	}


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
    public function getTitle()
    {
        return $this->title;
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
    public function getMarkdown()
    {
        return $this->markdown;
    }

    /**
     * @return string
     */
    public function getHtml()
    {
        return $this->html;
    }

    /**
     * @return string
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * @return string
     */
    public function getFeatured()
    {
        return $this->featured;
    }

    /**
     * @return string
     */
    public function getPage()
    {
        return $this->page;
    }

    /**
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @return string
     */
    public function getLocale()
    {
        return $this->locale;
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
    public function getPublishedAt()
    {
        return $this->publishedAt;
    }

    /**
     * @return string
     */
    public function getPublishedBy()
    {
        return $this->publishedBy;
    }

    /**
     * @return string
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * @return string
     */
    public function getLanguage()
    {
        return $this->language;
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
    public function getFeatureImage()
    {
        return $this->featureImage;
    }
}
