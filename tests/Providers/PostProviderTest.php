<?php

namespace GhostIO\Tests\Providers;

use PHPUnit_Framework_TestCase;
use GhostIO\Providers\PostProvider;

/**
*  Corresponding Class to test PostProvider class
*  @author Enrique <enrique@weebly.com>
*/
class PostProviderTest extends PHPUnit_Framework_TestCase
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
                       [ 'query' => [ 'fields' => ['id', 'html']] ]
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



/*
|--------------------------------------------------------------------------
| Dummy Classes
|--------------------------------------------------------------------------
|
| This classes will serve as helpers for the API response so we mock it
| and we dont actually go and send a request to the real server.
|
*/

class ResponseDummy
{
	private $body;

	public function getBody()
	{
		return $this->body;
	}

	public function setResponseBody(array $body)
	{
		$responseBody = new ResponseBodyDummy();
		$responseBody->setContents($body);
		$this->body = $responseBody;
	}
}

class ResponseBodyDummy
{
	private $contents;

	public function getContents()
	{
		return $this->contents;
	}

	public function setContents(array $contents)
	{
		$this->contents = json_encode($contents);
	}
}
