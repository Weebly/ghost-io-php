<?php 

use GhostIO\Entities\Post;

/**
*  Corresponding Class to test Post class
*  @author Enrique <enrique@weebly.com>
*/
class PostTest extends PHPUnit_Framework_TestCase
{

	protected $post;

	// Initialize the object to test it
	protected function setUp()
    {
        $this->post = new Post;
    }

	/**
	* Just check if the Post has no syntax error 
	*
	* This is just a simple check to make sure your library has no syntax error. This helps you troubleshoot
	* any typo before you even use this library in a real project.
	*
	*/
	public function testIsThereAnySyntaxError()
	{
		$this->assertTrue(is_object($this->post));
		unset($this->post);
	}

	/**
	 * Check that the post object can be json encoded and decoded.
	 */
	public function testPostCanBeReturnedAsJson()
	{
		$json = json_encode($this->post);
		$post = json_decode($json, true);

		$this->assertArrayHasKey('id', $post);
		$this->assertArrayHasKey('url', $post);
		$this->assertArrayHasKey('html', $post);
		$this->assertArrayHasKey('markdown', $post);
	}

}