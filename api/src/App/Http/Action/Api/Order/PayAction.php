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

		$body = $request->getParsedBody();

		try {
			$command = new Pay\Command($body['id'],$body['sum']);

			$this->handler->handle($command);

			return new JsonResponse(['success'=>true],200);
			
		} catch (\Exception $e) {

			return new JsonResponse(['error'=>$e->getMessage()],500);
		}
	}

	public function __invoke(ServerRequestInterface $request): ResponseInterface
	{
		return $this->handle($request);
	}
}