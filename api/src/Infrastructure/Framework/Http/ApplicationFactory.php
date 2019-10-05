<?php
namespace Infrastructure\Framework\Http;

use Framework\Http\Router\Router;
use Framework\Http\Application;
use Infrastructure\Framework\Http\Router\AuraRouterFactory;

class ApplicationFactory
{

	public function __invoke()
	{
		return new Application((new AuraRouterFactory())());
	}
}