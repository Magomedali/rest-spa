<?php
namespace App\Http\Api\Product;

use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;
use Zend\Diactoros\Response\JsonResponse;

class GenerateAction
{
	public function __invoke(ServerRequestInterface $request): ResponseInterface
	{
		return new JsonResponse(['handle'=>'Products generate'],200);
	}
}