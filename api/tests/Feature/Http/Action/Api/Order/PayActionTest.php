<?php
declare(strict_types=1);
namespace Test\Feature\Http\Action\Api\Order;

use App\Service\PaymentService;
use App\Module\Sale\Entity\Product;
use App\Module\Sale\Entity\Order;
use Test\Feature\DbWebTestCase;
use Test\Fixture\Order\OrderFixture;

class PayActionTest extends DbWebTestCase
{


    private $mockPayService;

	/**
     * This method is called before each test.
     */
    protected function setUp(): void
    {
    	parent::setUp();

    	$this->authorize();

        $this->mockPayService = $this->getMockBuilder(PaymentService::class)
                                                    ->disableOriginalConstructor()
                                                    ->getMock();
        $this->mockPayService->method('pay')
                                    ->willReturn(true);

        $this->getContainer()->setFactory(PaymentService::class, function() { return $this->mockPayService; });    
        $this->loadFixtures([
            'order'=>OrderFixture::class
        ]);
    }


    public function testPay()
    {	
    	$order = $this->getOrder();
        
        
        $response = $this->post('/pay',['id'=>$order->getId(),'sum'=>$order->getCost()->getValue()]);

    	self::assertEquals(200,$response->getStatusCode());
        self::assertJson($content = $response->getBody()->getContents());

    }


    public function testPayWrongSum()
    {   
        $order = $this->getOrder();
        
        $response = $this->post('/pay',['id'=>$order->getId(),'sum'=>$order->getCost()->getValue() - 1]);

        self::assertEquals(500,$response->getStatusCode());
        self::assertJson($content = $response->getBody()->getContents());

        $data = json_decode($content,true);
        self::assertEquals([
            'error'=>'Sum is not equals with order cost!'
        ],$data);
    }


    public function testTwicePay()
    {   
        $order = $this->getOrder();
        
        $this->post('/pay',['id'=>$order->getId(),'sum'=>$order->getCost()->getValue()]);

        $response = $this->post('/pay',['id'=>$order->getId(),'sum'=>$order->getCost()->getValue()]);

        self::assertEquals(500,$response->getStatusCode());
        self::assertJson($content = $response->getBody()->getContents());

        $data = json_decode($content,true);
        self::assertEquals([
            'error'=>'Order is already paid!'
        ],$data);

    }



    private function getOrder(): Order\Order
    {
        return $this->getFixture('order')->getOrder();
    }

}