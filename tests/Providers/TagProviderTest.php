<?php

namespace GhostIO\Tests\Providers;

use PHPUnit_Framework_TestCase;
use GhostIO\Providers\TagProvider;
use GhostIO\Tests\Mocks\ResponseDummy;
use GhostIO\Tests\Mocks\ResponseBodyDummy;

/**
*  Corresponding Class to test TagProvider class
*  @author Enrique <enrique@weebly.com>
*/
class TagProviderTest extends PHPUnit_Framework_TestCase
{

	protected $provider;
	protected $clientMock;

	// Initialize the object to test it
	protected function setUp()
    {
    	$this->clientMock = $this->initClientMock();
        $this->provider = TagProvider::getInstance($this->clientMock);
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


	public function testProvidersCanGetAllTagsWithOneResult()
	{
		// Prepare the mock so it returns the data we expect
		$apiResponse = new ResponseDummy();
		$apiResponse->setResponseBody([ 'tags' => [ 'id' => 0 ] ]);

        $this->clientMock->expects($this->once())
        		->method('request')
            	->willReturn($apiResponse);

		$result = $this->provider->getAll();

		$this->assertInstanceOf(\GhostIO\Utils\Collection::class, $result);

		$tag = $result->current();
		$this->assertNotNull($tag);
		$this->assertInstanceOf(\GhostIO\Entities\Tag::class, $tag);
	}


	public function testProvidersCanGetAllTagsWithFieldsParameter()
	{
		// Prepare the mock so it returns the data we expect
		$apiResponse = new ResponseDummy();
		$apiResponse->setResponseBody([ 'tags' => [ 'id' => 0 ] ]);

        $this->clientMock->expects($this->once())
        		->method('request')
        		->with(
                       	$this->equalTo('GET'),
                       	$this->equalTo('tags'),
                       	[
                       		'query' => [
                       			'fields' => ['id', 'html'],
                       			'limit' => 15
                       		]
                       	]
                   )
            	->willReturn($apiResponse);

		$result = $this->provider->getAll(['id', 'html']);

		$this->assertInstanceOf(\GhostIO\Utils\Collection::class, $result);

		$tag = $result->current();
		$this->assertNotNull($tag);
		$this->assertInstanceOf(\GhostIO\Entities\Tag::class, $tag);
	}

	/**
     * @expectedException Exception
     */
	public function testProvidersThrowsAnExceptionIfNoTagsAreReturned()
	{
		// Prepare the mock so it returns the data we expect
		$apiResponse = new ResponseDummy();
		$apiResponse->setResponseBody([ 'not_tags' => [ 'id' => 0 ] ]);

        $this->clientMock->expects($this->once())
        		->method('request')
            	->willReturn($apiResponse);

		$this->provider->getAll();
	}


	public function testProviderCanFindATagById()
	{
		// Prepare the mock so it returns the data we expect
		$apiResponse = new ResponseDummy();
		$apiResponse->setResponseBody([ 'tags' => [[ 'id' => 1 ]] ]);

        $this->clientMock->expects($this->once())
        		->method('request')
            	->willReturn($apiResponse);

		$tag = $this->provider->getById(1);

		$this->assertNotNull($tag);
		$this->assertInstanceOf(\GhostIO\Entities\Tag::class, $tag);
		$this->assertEquals($tag->getId(), 1);
	}

}


