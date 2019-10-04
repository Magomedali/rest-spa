<?php
namespace Framework\Http\Router;

class RouterNotFoundException extends \LogicException
{
	
	/**
	* @var string
	*/
	private $name;

	/**
	* @var array
	*/
	private $params;

	public function __construct($name,array $params,\Throwable $previous = null)
	{
		parent::__construct('Route "' . $name . '" not found.',0,$previous);
		$this->name = $name;
		$this->params = $params;
	}


	/**
	* @return string $name
	*/
	public function getName(): string
	{
		return $this->name;
	}

	/**
	* @return array $params
	*/
	public function getParams(): array
	{
		return $this->params;
	}
}