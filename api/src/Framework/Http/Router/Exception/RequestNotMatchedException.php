<?php
namespace Framework\Http\Router;

use ServerRequestInterface;

class RequestNotMatchedException extends \LogicException
{
	
	/**
	* @var ServerRequestInterface
	*/
	private $request;

	/**
	* @var array
	*/
	private $params;

	public function __construct(ServerRequestInterface $request)
	{
		parent::__construct('Matches not found');
		$this->request = $request;
	}


	/**
	* @return ServerRequestInterface $request
	*/
	public function getRequest(): ServerRequestInterface
	{
		return $this->request;
	}
	
}