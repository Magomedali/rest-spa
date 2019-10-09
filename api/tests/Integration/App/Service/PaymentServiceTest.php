<?php
declare(strict_types=1);
namespace Test\Integration\App\Service;

use PHPUnit\Framework\TestCase;
use App\Service\PaymentService;
use Buzz\Client\Curl;
use Zend\Diactoros\ResponseFactory;

class PaymentServiceTest extends TestCase
{

    /**
     * @var PaymentService
    */
    private $service;

	/**
     * This method is called before each test.
     */
    protected function setUp(): void
    {
    	parent::setUp();

        $this->service = new PaymentService(new Curl(new ResponseFactory()),PAYMENT_SERVICE);
    }


    public function testPayment()
    {	
    	
        $isSuccess = $this->service->pay(1,200);
        
    	self::assertTrue($isSuccess);

    }



}