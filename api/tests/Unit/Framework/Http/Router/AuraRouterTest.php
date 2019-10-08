<?php
namespace Test\Framework\Http\Router;

use Framework\Http\Router\Exception\RequestNotMatchedException;
use Framework\Http\Router\Exception\RouterNotFoundException;
use Framework\Http\Router\AuraRouter;
use Framework\Http\Router\Router;
use Framework\Http\Router\RouteData;
use Psr\Http\Message\ServerRequestInterface;
use Aura\Router\RouterContainer;
use PHPUnit\Framework\TestCase;
use Zend\Diactoros\ServerRequest;
use Zend\Diactoros\Uri;

class AuraRouterTest extends TestCase
{

	public function testValidMethod()
	{
		$router = $this->buildRouter();

		$router->addRoute($getData = new RouteData('product','/product','get_product_handler',['GET'],[]));
		$router->addRoute($postData = new RouteData('product_edit','/product','edit_product_handler',['POST'],[]));

		$result = $router->match($this->buildRequest('GET','/product'));
		$this->assertEquals($getData->name,$result->getName());
		$this->assertEquals($getData->handler,$result->getHandler());

		$result = $router->match($this->buildRequest('POST','/product'));
		$this->assertEquals($postData->name,$result->getName());
		$this->assertEquals($postData->handler,$result->getHandler());
	}



	public function testMissingMethod()
	{
		$router = $this->buildRouter();

		$router->addRoute($getData = new RouteData('product','/product','get_product_handler',['GET'],[]));

		$this->expectException(RequestNotMatchedException::class);
		$router->match($this->buildRequest('DELETE','/product'));
	}



	public function testValidAttributes()
	{
		$router = $this->buildRouter();

		$router->addRoute($getData = new RouteData('product','/product/{id}','get_product_handler',['GET'],['tokens'=>['id'=>'\d+']]));

		$result = $router->match($this->buildRequest('GET','/product/2'));

		$this->assertEquals($getData->name,$result->getName());
		$this->assertEquals(['id'=>2],$result->getAttributes());
	}



	public function testIncorrectAttributes()
	{
		$router = $this->buildRouter();

		$router->addRoute($getData = new RouteData('product','/product/{id}','get_product_handler',['GET'],['tokens'=>['id'=>'\d+']]));

		$this->expectException(RequestNotMatchedException::class);
		$result = $router->match($this->buildRequest('GET','/product'));
	}



	private function buildRouter(): Router
	{
		return new AuraRouter(new RouterContainer());
	}


	private function buildRequest($method, $uri): ServerRequest
	{
		return (new ServerRequest())
					->withMethod($method)
					->withUri(new Uri($uri));
	} 
}