<?php
namespace App\Http\Api\Product;

use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;
use Zend\Diactoros\Response\JsonResponse;

class BuyAction
{
	public function __invoke(ServerRequestInterface $request): ResponseInterface
	{
		$id = $request->getAttributes()['id'];

		return new JsonResponse(['handle'=>'Buy #'.$id.' product'],200);
	}
}