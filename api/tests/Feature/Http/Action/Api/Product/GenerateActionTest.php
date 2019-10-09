<?php
declare(strict_types=1);
namespace Test\Feature\Http\Action\Api\Product;

use App\Module\Sale\Entity\Product;
use Test\Feature\DbWebTestCase;
use Test\Fixture\Product\ProductFixture;

class GenerateActionTest extends DbWebTestCase
{

	/**
     * This method is called before each test.
     */
    protected function setUp(): void
    {
    	parent::setUp();

    	$this->authorize();
    }


    public function testProductGenerate()
    {	
    	$response = $this->put('/product',[]);
    	self::assertEquals(200,$response->getStatusCode());

    	$response = $this->get('/product',[]);

    	self::assertEquals(200,$response->getStatusCode());
    	self::assertJson($content = $response->getBody()->getContents());
    	$data = json_decode($content,true);

    	self::assertCount(20,$data);

    	$item = reset($data);

    	self::assertArrayHasKey('id',$item);
    	self::assertArrayHasKey('name',$item);
    	self::assertArrayHasKey('price',$item);
    }


}