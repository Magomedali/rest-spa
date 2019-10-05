<?php
namespace App\Http\Action\Api\Product;

use Psr\Http\Server\RequestHandlerInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;
use Zend\Diactoros\Response\JsonResponse;

use App\Module\Sale\UseCase\Product\Generate;

class GenerateAction implements RequestHandlerInterface
{

	private $handler;

	public function __construct(Generate\Handler $generateGandler)
	{
		$this->handler = $generateGandler;
	}

	public function handle(ServerRequestInterface $request): ResponseInterface
	{
		$command = new Generate\Command();

		try {
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