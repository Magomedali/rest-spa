<?php
declare(strict_types=1);
namespace Test\Feature\Http\Action\Api\Order;

use App\Module\Sale\Entity\Product;
use App\Module\Sale\Entity\Order;
use Test\Feature\DbWebTestCase;
use Test\Fixture\Product\ProductFixture;

class CreateActionTest extends DbWebTestCase
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


    public function testCreate()
    {	
    	$product = $this->getFixture('product')->getProduct();
    	
    	$response = $this->put('/order',[$product->getId()]);

    	self::assertEquals(200,$response->getStatusCode());
    	self::assertJson($content = $response->getBody()->getContents());
    	
        $data = json_decode($content,true);

    	self::assertArrayHasKey('id',$data);
    	self::assertNotNull($data['id']);
    	self::assertGreaterThan(0,$data['id']);
    }


}