<?php
namespace App\Http\Action\Api\Order;

use Psr\Http\Server\RequestHandlerInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;
use Zend\Diactoros\Response\JsonResponse;

use App\Module\Sale\UseCase\Order\Pay;

class PayAction implements RequestHandlerInterface
{

	private $handler;

	
	public function __construct(Pay\Handler $handler)
	{
		$this->handler = $handler;
	}
	
	public function handle(ServerRequestInterface $request): ResponseInterface
	{

		$command = $this->deserialize($request);

		$this->handler->handle($command);

		return new JsonResponse(['success'=>true],200);
		
	}

	public function __invoke(ServerRequestInterface $request): ResponseInterface
	{
		return $this->handle($request);
	}


	private function deserialize(ServerRequestInterface $request): Pay\Command
    {
        $body = $request->getParsedBody();
        return new Pay\Command($body['id'],$body['sum']);
    }
}