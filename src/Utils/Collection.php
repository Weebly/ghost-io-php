<?php

namespace GhostIO\Utils;

use Iterator;

class Collection implements Iterator
{
	private $items = [];

	/**
	 * Clears the items inside the collection
	 * @return void
	 */
	public function clear() 
	{
		$this->items = [];
	}

	/**
	 * Check if we have any items
	 * @return boolean
	 */
	public function isEmpty()
	{
		return sizeof($this->items) > 0;
	}

	/**
	 * returns the Collection as array.
	 * @return array The collection data as array
	 */
	public function toArray()
	{
		return $this->items;
	}

	/**
	 * Add a new item to the colelction
	 * @param mixed $item Any item we want to add
	 */
	public function add($item)
	{
		$this->items[] = $item;
	}

	/**
	 * Returns the pointer of the array to the first position
	 * @return array 
	 */
	function rewind() 
	{
		return reset($this->items);
	}

	/**
	 * Gives us the current element of the array
	 * @return mixed The item that is selected by the pointer
	 */
	function current() 
	{
		return current($this->items);
	}

	/**
	 * Gives us the key of the current item
	 * @return key The key
	 */
	function key() 
	{
		return key($this->items);
	}

	/**
	 * Changes the pointer to the next element
	 * @return mixed The next item
	 */
	function next() 
	{
		return next($this->items);
	}

	/**
	 * Check if the current element is something 
	 * @return bool if the element is valid
	 */
	function valid() 
	{
		return key($this->items) !== null;
	}

}