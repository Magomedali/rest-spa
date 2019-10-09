<?php
declare(strict_types=1);
namespace App\Http\Action\Api;

use Psr\Http\Server\RequestHandlerInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response\JsonResponse;

class VersionAction implements RequestHandlerInterface
{


	public function handle(ServerRequestInterface $request): ResponseInterface
	{
		return new JsonResponse([
			'name'=>'Shop Api',
			'version'=>'1.0.0'
		],200);
	}
}