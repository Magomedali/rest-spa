<?php
namespace Framework\Http\Router;

use Aura\Router\Route;
use Aura\Router\RouterContainer;
use Aura\Router\Exception\RouteNotFound;
use Psr\Http\Message\ServerRequestInterface;
use Framework\Http\Router\Exception\RequestNotMatchedException;
use Framework\Http\Router\Exception\RouterNotFoundException;

class AuraRouter implements Router
{

	/**
	* @var RouterContainer
	*/
	private $aura;


	public function __construct(RouterContainer $aura)
	{
		$this->aura = $aura;
	}



	/**
	 * @param ServerRequestInterface $request
	 * @throws RequestNotMatchedException
	 * @return Result
	*/
	public function match(ServerRequestInterface $request): Result
	{
		$matcher = $this->aura->getMatcher();
		if($route = $matcher->match($request))
		{
			return new Result($route->name, $route->handler, $route->attributes);
		}

		throw new RequestNotMatchedException($request);
	}




	/**
	 * @param string $name
	 * @param array $params
	 * @throws RouterNotFoundException
	 * @return string 
	*/
	public function generate($name, array $params): string
	{
		$generator = $this->aura->getGenerator();
		try {
			return $generator->generate($name,$params);
		} catch (RouteNotFound $e) {
			throw new RouterNotFoundException($name,$params,$e);
		}
	}


	/**
	 * @param RouteData $data
	*/
	public function addRoute(RouteData $data):void
	{

		$route = new Route();
		$route->name($data->name);
        $route->path($data->path);
        $route->handler($data->handler);

        foreach ($data->options as $name => $value) {
            switch ($name) {
                case 'tokens':
                    $route->tokens($value);
                    break;
                case 'defaults':
                    $route->defaults($value);
                    break;
                case 'wildcard':
                    $route->wildcard($value);
                    break;
                default:
                    throw new \InvalidArgumentException('Undefined option "' . $name . '"');
            }
        }

        if($methods = $data->methods){
        	$route->allows($methods);
        }

        $this->aura->getMap()->addRoute($route);
	}

}