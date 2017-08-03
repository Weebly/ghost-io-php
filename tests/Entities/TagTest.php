<?php 

use GhostIO\Entities\Tag;

/**
*  Corresponding Class to test Tag class
*  @author Enrique <enrique@weebly.com>
*/
class TagTest extends PHPUnit_Framework_TestCase
{

	protected $tag;

	// Initialize the object to test it
	protected function setUp()
    {
        $this->tag = new Tag;
    }

	/**
	* Just check if the Tag has no syntax error 
	*
	* This is just a simple check to make sure your library has no syntax error. This helps you troubleshoot
	* any typo before you even use this library in a real project.
	*
	*/
	public function testIsThereAnySyntaxError()
	{
		$this->assertTrue(is_object($this->tag));
		unset($this->tag);
	}

	/**
	 * Check that the tag object can be json encoded and decoded.
	 */
	public function testTagCanBeReturnedAsJson()
	{
		$json = json_encode($this->tag);
		$tag = json_decode($json, true);

		$this->assertArrayHasKey('id', $tag);
		$this->assertArrayHasKey('name', $tag);
		$this->assertArrayHasKey('slug', $tag);
	}

}