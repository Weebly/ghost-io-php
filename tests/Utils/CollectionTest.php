<?php

namespace GhostIO\Tests\Utils;

use PHPUnit\Framework\TestCase;
use GhostIO\Utils\Collection;

/**
*  Corresponding Class to test the collections class
*  @author Enrique <enrique@weebly.com>
*/
class PostProviderTest extends TestCase
{

	protected $collection;

	// Initialize the object to test it
	protected function setUp()
    {
    	$this->collection = new Collection();
    }

    public function testIsEmptyMethod()
    {
    	$this->assertTrue($this->collection->isEmpty());
    	$this->collection->add([ 'some' => 'item' ]);
    	$this->assertFalse($this->collection->isEmpty());
    }

    public function testClearMethodRemovesEverythingFromTheCollection()
    {
    	$this->collection->add([ 'some' => 'item' ]);
    	$this->collection->clear();

    	$this->assertTrue($this->collection->isEmpty());
    }

    public function testCollectionToArray()
    {
    	$this->collection->add([ 'some'    => 'item1' ]);
    	$this->collection->add([ 'another' => 'item2' ]);
    	$this->assertEquals(
    		$this->collection->toArray(),
    		[
    			[ 'some' => 'item1' ],
    			[ 'another' => 'item2' ]
    		]
    	);
    }

}
