<?php
namespace App\Http\Action\Api\Product;

use Psr\Http\Server\RequestHandlerInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;
use Zend\Diactoros\Response\JsonResponse;

class BuyAction implements RequestHandlerInterface
{


	
	public function handle(ServerRequestInterface $request): ResponseInterface
	{
		$id = $request->getAttributes()['id'];

		return new JsonResponse(['handle'=>'Buy #'.$id.' product'],200);
	}

	public function __invoke(ServerRequestInterface $request): ResponseInterface
	{
		return $this->handle($request);
	}
}