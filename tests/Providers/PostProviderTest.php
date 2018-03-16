<?php

namespace GhostIO\Tests\Providers;

use PHPUnit\Framework\TestCase;
use GhostIO\Providers\PostProvider;
use GhostIO\Tests\Mocks\ResponseDummy;
use GhostIO\Tests\Mocks\ResponseBodyDummy;

/**
*  Corresponding Class to test PostProvider class
*  @author Enrique <enrique@weebly.com>
*/
class PostProviderTest extends TestCase
{

	protected $provider;
	protected $clientMock;

	// Initialize the object to test it
	protected function setUp()
    {
    	$this->clientMock = $this->initClientMock();
        $this->provider = PostProvider::getInstance($this->clientMock);
        $this->provider->setClient($this->clientMock);
    }

    private function initClientMock()
    {
    	return $this->getMockBuilder('\GhostIO\Client')
                     ->disableOriginalConstructor()
                     ->setMethods(['request'])
                     ->getMock();
    }

	/**
	* Just check if the're not syntax error
	*
	* This is just a simple check to make sure your library has no syntax error. This helps you troubleshoot
	* any typo before you even use this library in a real project.
	*
	*/
	public function testIsThereAnySyntaxError()
	{
		$this->assertTrue(is_object($this->provider));
		unset($this->provider);
	}


	public function testProvidersCanGetAllPostsWithOneResult()
	{
		// Prepare the mock so it returns the data we expect
		$apiResponse = new ResponseDummy();
		$apiResponse->setResponseBody([ 'posts' => [ 'id' => 0 ] ]);

        $this->clientMock->expects($this->once())
        		->method('request')
            	->willReturn($apiResponse);

		$result = $this->provider->getAll();

		$this->assertInstanceOf(\GhostIO\Utils\Collection::class, $result);

		$post = $result->current();
		$this->assertNotNull($post);
		$this->assertInstanceOf(\GhostIO\Entities\Post::class, $post);
	}


	public function testProvidersCanGetAllPostsWithFieldsParameter()
	{
		// Prepare the mock so it returns the data we expect
		$apiResponse = new ResponseDummy();
		$apiResponse->setResponseBody([ 'posts' => [ 'id' => 0 ] ]);

        $this->clientMock->expects($this->once())
        		->method('request')
        		->with(
                       $this->equalTo('GET'),
                       $this->equalTo('posts'),
                       	[
                       		'query' => [
                       			'fields' => ['id', 'html'],
                       			'limit' => 15,
                       			'formats' => ['html', 'plaintext'],
                       			'include' => ['tags']
                       		]
                       	]
                   )
            	->willReturn($apiResponse);

		$result = $this->provider->getAll(['id', 'html']);

		$this->assertInstanceOf(\GhostIO\Utils\Collection::class, $result);

		$post = $result->current();
		$this->assertNotNull($post);
		$this->assertInstanceOf(\GhostIO\Entities\Post::class, $post);
	}

	/**
     * @expectedException Exception
     */
	public function testProvidersThrowsAnExceptionIfNoPostsAreReturned()
	{
		// Prepare the mock so it returns the data we expect
		$apiResponse = new ResponseDummy();
		$apiResponse->setResponseBody([ 'not_posts' => [ 'id' => 0 ] ]);

        $this->clientMock->expects($this->once())
        		->method('request')
            	->willReturn($apiResponse);

		$this->provider->getAll();
	}


	public function testProviderCanFindAPostById()
	{
		// Prepare the mock so it returns the data we expect
		$apiResponse = new ResponseDummy();
		$apiResponse->setResponseBody([ 'posts' => [[ 'id' => 1 ]] ]);

        $this->clientMock->expects($this->once())
        		->method('request')
            	->willReturn($apiResponse);

		$post = $this->provider->getById(1);

		$this->assertNotNull($post);
		$this->assertInstanceOf(\GhostIO\Entities\Post::class, $post);
		$this->assertEquals($post->getId(), 1);
	}

}

