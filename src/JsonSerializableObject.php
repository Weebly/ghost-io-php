<?php

namespace GhostIO;

use JsonSerializable;

/**
* Class that contains the implementation of the JsonSerializable for objects
*/
abstract class JsonSerializableObject implements JsonSerializable
{

	// function called when encoded with json_encode
    public function jsonSerialize()
    {
        return get_object_vars($this);
    }

}