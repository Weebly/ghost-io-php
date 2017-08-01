<?php 

use GhostIO\Entities\User;

/**
*  Corresponding Class to test User class
*  @author Enrique <enrique@weebly.com>
*/
class UserTest extends PHPUnit_Framework_TestCase
{

	protected $user;

	// Initialize the object to test it
	protected function setUp()
    {
        $this->user = new User;
    }

	/**
	* Just check if the User has no syntax error 
	*
	* This is just a simple check to make sure your library has no syntax error. This helps you troubleshoot
	* any typo before you even use this library in a real project.
	*
	*/
	public function testIsThereAnySyntaxError()
	{
		$this->assertTrue(is_object($this->user));
		unset($this->user);
	}

	/**
	 * Check that the user object can be json encoded and decoded.
	 */
	public function testUserCanBeReturnedAsJson()
	{
		$json = json_encode($this->user);
		$user = json_decode($json, true);

		$this->assertArrayHasKey('id', $user);
		$this->assertArrayHasKey('bio', $user);
		$this->assertArrayHasKey('location', $user);
		$this->assertArrayHasKey('website', $user);
	}

}