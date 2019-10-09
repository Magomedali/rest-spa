<?php
declare(strict_types=1);
namespace App\Module\Sale\UseCase\Product\Generate;


class Command
{

	/**
	* @var int
	*/
	private $count;


	public function __construct(int $count = 20)
	{
		$this->count = $count;
	}


	public function getCount(): int
	{
		return $this->count;
	}
}