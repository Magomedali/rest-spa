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
			
		$command = $this->deserialize($request);

		$id = $this->handler->handle($command);

		return new JsonResponse(['id'=>$id],200);
			
	}



	public function __invoke(ServerRequestInterface $request): ResponseInterface
	{
		return $this->handle($request);
	}



	private function deserialize(ServerRequestInterface $request): Create\Command
    {
        $ids = $request->getParsedBody();

        return new Create\Command(is_array($ids) ? $ids : []);
    }
}