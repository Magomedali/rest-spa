<?php
namespace Framework\Http;

use Psr\Http\Server\RequestHandlerInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response\JsonResponse;
use Framework\Http\Router\Exception\RequestNotMatchedException;
use Framework\Http\Router\RouteData;
use Framework\Http\Router\Router;

class Application implements RequestHandlerInterface
{

    private $router;


	public function __construct(Router $router)
	{
        $this->router = $router;
	}

    public function any($name, $path, $handler, array $options = []): void
    {
        $this->route($name, $path, $handler, $options);
    }


    public function get($name, $path, $handler, array $options = []): void
    {
        $this->route($name, $path, $handler, ['GET'], $options);
    }


    public function post($name, $path, $handler, array $options = []): void
    {
        $this->route($name, $path, $handler, ['POST'], $options);
    }


    public function put($name, $path, $handler, array $options = []): void
    {
        $this->route($name, $path, $handler, ['PUT'], $options);
    }


    public function patch($name, $path, $handler, array $options = []): void
    {
        $this->route($name, $path, $handler, ['PATCH'], $options);
    }


    public function delete($name, $path, $handler, array $options = []): void
    {
        $this->route($name, $path, $handler, ['DELETE'], $options);
    }


	public function handle(ServerRequestInterface $request): ResponseInterface
	{
		try {

			$result = $this->router->match($request);
			foreach ($result->getAttributes() as $attribute => $value) {
				$request = $request->withAttribute($attribute,$value);
			}

			$action = $result->getHandler();
			
			return $action($request);
		} catch (RequestNotMatchedException $e) {
			return new JsonResponse(['error'=>'Undefained resourse'],404);
		}
		
	}

	private function route($name, $path, $handler, array $methods, array $options = []): void
    {
        $this->router->addRoute(new RouteData($name, $path, $handler, $methods, $options));
    }
}