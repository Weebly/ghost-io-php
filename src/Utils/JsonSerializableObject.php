<?php

namespace GhostIO\Utils;

use JsonSerializable;

/**
* Class that contains the implementation of the JsonSerializable for objects
*/
abstract class JsonSerializableObject implements JsonSerializable
{

	/**
	 * This method gets all the properties for the entities and 
	 * makes them part of the encoded json when running json_encode.
	 * @return array  	All properties
	 */
    public function jsonSerialize()
    {
        return get_object_vars($this);
    }

}