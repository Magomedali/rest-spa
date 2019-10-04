<?php
namespace Framework\Http\Router;

use Psr\Http\Message\ServerRequestInterface;
use Framework\Http\Router\Exception\RequestNotMatchedException;
use Framework\Http\Router\Exception\RouterNotFoundException;

interface Router
{

	/**
	 * @param ServerRequestInterface $request
	 * @throws RequestNotMatchedException
	 * @return Result
	*/
	public function match(ServerRequestInterface $request): Result;

	/**
	 * @param string $name
	 * @param array $params
	 * @throws RouterNotFoundException
	 * @return string 
	*/
	public function generate($name, array $params): string;


	/**
	 *
	 * @param RouterData $data
	*/
	public function addRoute(RouteData $data):void;

}