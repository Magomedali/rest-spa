<?php
namespace Framework\Http\Router;


class Result
{

	/**
	* @var string
	*/
	private $name;


	/**
	* @var mixed
	*/
	private $handler;


	/**
	* @var array
	*/
	private $attributes;



	public function __construct($name, $handler,array $attributes)
	{
		$this->name = $name;
        $this->handler = $handler;
        $this->attributes = $attributes;
	}


	/**
	* @return string $name
	*/
	public function getName(): string
    {
        return $this->name;
    }


    /**
	* @return mixed $handler
	*/
    public function getHandler()
    {
        return $this->handler;
    }


    /**
	* @return array $attributes
	*/
    public function getAttributes(): array
    {
        return $this->attributes;
    }
}