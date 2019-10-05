<?php
namespace App\Http\Middleware;

use Psr\Http\Server\RequestHandlerInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;
use Zend\Diactoros\Response\JsonResponse;

class NotFoundHandler implements RequestHandlerInterface
{

	public function handle(ServerRequestInterface $request): ResponseInterface
	{
		return new JsonResponse(['handle'=>'Undefined resources'],404);
	}

	public function __invoke(ServerRequestInterface $request): ResponseInterface
	{
		return $this->handle($request);
	}
}