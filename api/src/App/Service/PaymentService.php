<?php
declare(strict_types=1);
namespace App\Service;

use Psr\Http\Client\ClientInterface;
use Zend\Diactoros\RequestFactory;

class PaymentService
{

    /**
     * @var ClientInterface
    */
    private $client;

    /**
     * @var string
    */
    private $account_id;

    /**
     * @var string
    */
    private $account_secret;

    /**
     * @var string
    */
    private $service;


    /**
     * @param ClientInterface $client
     * @param string $uri
     * @param int $account_id
     * @param string $account_secret
    */
    public function __construct(ClientInterface $client,string $service, int $account_id = null,string $account_secret = null)
    {
        $this->client = $client;
        $this->service = $service;
        $this->account_id = $account_id;
        $this->account_secret = $account_secret;
    }

    

    /**
    * @param int $order_id
    * @param int $sum
    * @return boolean
    */
    public function pay(int $order_id, int $sum): bool
    {
        $request = RequestFactory::createRequest('GET',$this->service); 
        
        $response = $this->client->sendRequest($request);

        return $response->getStatusCode() === 200;

    }

}