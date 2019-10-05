<?php
namespace App\Http\Action\Api\Order;

use Psr\Http\Server\RequestHandlerInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;
use Zend\Diactoros\Response\JsonResponse;

use App\Module\Sale\UseCase\Order\Create;

class CreateAction implements RequestHandlerInterface
{

	private $handler;

	
	public function __construct(Create\Handler $handler)
	{
		$this->handler = $handler;
	}

	
	public function handle(ServerRequestInterface $request): ResponseInterface
	{

		$ids = $request->getParsedBody();

		try {
			$command = new Create\Command(is_array($ids) ? $ids : []);

			$id = $this->handler->handle($command);

			return new JsonResponse(['id'=>$id],200);
			
		} catch (\Exception $e) {

			return new JsonResponse(['error'=>$e->getMessage()],500);
		}
		
	}


	public function __invoke(ServerRequestInterface $request): ResponseInterface
	{
		return $this->handle($request);
	}
}