<?php
declare(strict_types=1);
namespace App\Module\Sale\UseCase\Order\Pay;


class Command
{

	/**
	* @var int $id
	*/
	private $id;


	/**
	* @var int $sum
	*/
	private $sum;


	public function __construct(int $id, int $sum)
	{
		$this->id = $id;
		$this->sum = $sum;
	}


	public function getId(): int
	{
		return $this->id;
	}

	public function getSum(): int
	{
		return (int)$this->sum;
	}
}