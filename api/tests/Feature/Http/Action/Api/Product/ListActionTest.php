<?php
declare(strict_types=1);
namespace Test\Feature\Http\Action\Api\Product;

use App\Module\Sale\Entity\Product;
use Test\Feature\DbWebTestCase;
use Test\Fixture\Product\ProductFixture;

class ListActionTest extends DbWebTestCase
{

	/**
     * This method is called before each test.
     */
    protected function setUp(): void
    {
    	parent::setUp();

    	$this->authorize();

    	$this->loadFixtures([
    		'product'=>ProductFixture::class
    	]);
    }


    public function testList()
    {
    	$response = $this->get('/product',[]);

    	self::assertEquals(200,$response->getStatusCode());
    	self::assertJson($content = $response->getBody()->getContents());
    	$data = json_decode($content,true);

    	self::assertCount(1,$data);

    	$item = reset($data);
    	$product = $this->getFixture('product')->getProduct();

    	self::assertArrayHasKey('id',$item);
    	self::assertArrayHasKey('name',$item);
    	self::assertArrayHasKey('price',$item);
    	self::assertNotNull($item['id']);
    	self::assertGreaterThan(0,$item['id']);
    	self::assertEquals($product->getId(),$item['id']);
        self::assertEquals($product->getName()->getValue(),$item['name']);
    	self::assertEquals($product->getPrice()->getValue(),$item['price']);
    }



}