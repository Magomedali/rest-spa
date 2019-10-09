<?php
declare(strict_types=1);
namespace App\Module\Sale\Entity\Product;


class Name
{
	private $value;


	public function __construct(string $name)
	{
		$this->value = trim(strip_tags($name));
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