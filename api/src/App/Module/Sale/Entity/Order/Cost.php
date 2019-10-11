<?php
declare(strict_types=1);
namespace App\Module\Sale\Entity\Order;


class Cost
{
	private $value;


	public function __construct(int $cost)
	{
		$this->value = $cost;
	}

	public function getValue(): int
	{
		return $this->value;
	}

	public function isEqual(Cost $cost): bool
	{
		return $this->getValue() === $cost->getValue();
	}

	public function __toString()
	{
		return $this->getValue();
	}
}