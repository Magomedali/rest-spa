<?php
namespace Infrastructure\Framework\Http;

use Zend\Diactoros\Response;
use Framework\Http\Router\Router;
use Framework\Http\Application;
use Framework\Http\Pipeline\MiddlewareResolver;
use Infrastructure\Framework\Http\Router\AuraRouterFactory;
use App\Http\Middleware\NotFoundHandler;

class ApplicationFactory
{

	public function __invoke()
	{
		return new Application(
			new MiddlewareResolver(new Response()),
			(new AuraRouterFactory())(),
			new NotFoundHandler()
		);
	}
}