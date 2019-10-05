<?php
namespace App\Http\Action\Api\Order;

use Psr\Http\Server\RequestHandlerInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;
use Zend\Diactoros\Response\JsonResponse;

class CreateAction implements RequestHandlerInterface
{


	
	public function handle(ServerRequestInterface $request): ResponseInterface
	{
		return new JsonResponse(['handle'=>'Buy product'],200);
	}


	public function __invoke(ServerRequestInterface $request): ResponseInterface
	{
		return $this->handle($request);
	}
}