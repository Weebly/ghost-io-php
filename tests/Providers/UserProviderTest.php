<?php

namespace GhostIO\Tests\Providers;

use PHPUnit_Framework_TestCase;
use GhostIO\Providers\UserProvider;
use GhostIO\Tests\Mocks\ResponseDummy;
use GhostIO\Tests\Mocks\ResponseBodyDummy;

/**
*  Corresponding Class to test UserProvider class
*  @author Enrique <enrique@weebly.com>
*/
class UserProviderTest extends PHPUnit_Framework_TestCase
{

	protected $provider;
	protected $clientMock;

	// Initialize the object to test it
	protected function setUp()
    {
    	$this->clientMock = $this->initClientMock();
        $this->provider = UserProvider::getInstance($this->clientMock);
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


	public function testProvidersCanGetAllUsersWithOneResult()
	{
		// Prepare the mock so it returns the data we expect
		$apiResponse = new ResponseDummy();
		$apiResponse->setResponseBody([ 'users' => [ 'id' => 0 ] ]);

        $this->clientMock->expects($this->once())
        		->method('request')
            	->willReturn($apiResponse);

		$result = $this->provider->getAll();

		$this->assertInstanceOf(\GhostIO\Utils\Collection::class, $result);

		$user = $result->current();
		$this->assertNotNull($user);
		$this->assertInstanceOf(\GhostIO\Entities\User::class, $user);
	}


	public function testProvidersCanGetAllUsersWithFieldsParameter()
	{
		// Prepare the mock so it returns the data we expect
		$apiResponse = new ResponseDummy();
		$apiResponse->setResponseBody([ 'users' => [ 'id' => 0 ] ]);

        $this->clientMock->expects($this->once())
        		->method('request')
        		->with(
                       $this->equalTo('GET'),
                       $this->equalTo('users'),
                       [ 'query' => [ 'fields' => ['id', 'html']] ]
                   )
            	->willReturn($apiResponse);

		$result = $this->provider->getAll(['id', 'html']);

		$this->assertInstanceOf(\GhostIO\Utils\Collection::class, $result);

		$user = $result->current();
		$this->assertNotNull($user);
		$this->assertInstanceOf(\GhostIO\Entities\User::class, $user);
	}

	/**
     * @expectedException Exception
     */
	public function testProvidersThrowsAnExceptionIfNoUsersAreReturned()
	{
		// Prepare the mock so it returns the data we expect
		$apiResponse = new ResponseDummy();
		$apiResponse->setResponseBody([ 'not_users' => [ 'id' => 0 ] ]);

        $this->clientMock->expects($this->once())
        		->method('request')
            	->willReturn($apiResponse);

		$this->provider->getAll();
	}


	public function testProviderCanFindAUserById()
	{
		// Prepare the mock so it returns the data we expect
		$apiResponse = new ResponseDummy();
		$apiResponse->setResponseBody([ 'users' => [[ 'id' => 1 ]] ]);

        $this->clientMock->expects($this->once())
        		->method('request')
            	->willReturn($apiResponse);

		$user = $this->provider->getById(1);

		$this->assertNotNull($user);
		$this->assertInstanceOf(\GhostIO\Entities\User::class, $user);
		$this->assertEquals($user->getId(), 1);
	}

}

