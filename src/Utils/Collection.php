<?php

namespace GhostIO\Utils;

use Traversable;
use Countable;
use JsonSerializable;

class Collection
{
	private $items = [];

	public function clear() 
	{
		$this->items = [];
	}

	public function isEmpty()
	{
		return sizeof($this->items) > 0;
	}

	public function toArray()
	{
		return $this->items;
	}

	public function add($item)
	{
		$this->items[] = $item;
	}

}