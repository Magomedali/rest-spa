<?php
namespace App\Module\Sale\Entity\Product;


class Price
{
	private $value;


	public function __construct(int $price)
	{
		$this->value = $price;
	}

	public function getValue()
	{
		return $this->value;
	}

	public function __toString()
	{
		return $this->getValue();
	}
}