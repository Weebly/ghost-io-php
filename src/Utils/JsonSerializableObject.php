<?php

namespace GhostIO\Utils;

use JsonSerializable;

/**
* Class that contains the implementation of the JsonSerializable for objects. This
* abstract class is used by the entities so they are all serializable as json
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

    /**
     * Constructor. We want to make sure that when we send data to it, it will
     * add those values to the property of the object.
     * @param array $data 	Data for the object
     */
    function __construct($data = null)
	{
		if ($data) {
			foreach ($data as $key => $value) {
				$key = str_replace(' ', '', ucwords(str_replace('_', ' ', $key)));
				$key = lcfirst($key);

				$this->{$key} = $value;
			}
		}
	}

}