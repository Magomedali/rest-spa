<?php
namespace Infrastructure\Framework\Http;

use Zend\Diactoros\Response;
use Psr\Container\ContainerInterface;

use Framework\Http\Router\Router;
use Framework\Http\Pipeline\MiddlewareResolver;
use Framework\Http\Application;
use App\Http\Middleware\NotFoundHandler;

class ApplicationFactory
{

	public function __invoke(ContainerInterface $container)
	{
		return new Application(
			$container->get(MiddlewareResolver::class),
			$container->get(Router::class),
			$container->get(NotFoundHandler::class)
		);
	}
}