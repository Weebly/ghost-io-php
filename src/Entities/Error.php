<?php

namespace GhostIO\Entities;

use GhostIO\Utils\JsonSerializableObject;

class Error extends JsonSerializableObject
{
	protected $code;
	protected $message;
	protected $errorType;

	/**
     * Constructor. We want to make sure that when we send data to it, it will
     * add those values to the property of the object.
     * @param array $data 	Data for the object
     */
    function __construct($data = null)
	{
		// If we have data as parameter, set the property values
		if ($data) {
			foreach ($data as $key => $value) {
				$this->{$key} = $value;
			}
		}
	}

    /**
     * @return string
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * @return string
     */
    public function getErrorType()
    {
        return $this->errorType;
    }

    /**
     * @return string
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * @param string $code
     * @return self
     */
    public function setCode($code)
    {
    	// Check that is a real error
    	if ($code == 200 || $code == 201) {
    		throw new \Exception('This is not an error. Response code: ' . $code);

    	}

        $this->code = $code;
        return $this;
    }
}
