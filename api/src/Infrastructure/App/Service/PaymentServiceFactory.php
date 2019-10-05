<?php
namespace Infrastructure\App\Service;

use Psr\Container\ContainerInterface;
use App\Service\PaymentService;
use Buzz\Client\Curl;
use Zend\Diactoros\ResponseFactory;

class PaymentServiceFactory
{
    public function __invoke(ContainerInterface $container)
    {
        $config = $container->get('config')['payment'];

        return new PaymentService(new Curl(new ResponseFactory()),$config['service'],$config['account_id'],$config['account_secret']);
    }
}