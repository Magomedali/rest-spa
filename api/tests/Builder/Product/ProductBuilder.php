<?php
namespace Test\Builder\Product;

use App\Module\Sale\Entity\Product;

class ProductBuilder
{
	
	/**
	* @var Product\Name
	*/
	private $name;


	/**
	* @var Product\Price
	*/
	private $price;


	public function __construct()
	{
		$this->name = new Product\Name("example");
		$this->price = new Product\Price(1000);
	}


	public static function instance(): self
	{
		return new self();
	}


	public function withName(Product\Name $name): self
	{
		$clone = clone $this;
		$clone->name = $name;
		return $clone;
	}


	public function withPrice(Product\Price $price): self
	{
		$clone = clone $this;
		$clone->price = $price;
		return $clone;
	}


	public function build(): Product\Product
	{
		return new Product\Product($this->name, $this->price);
	}
}