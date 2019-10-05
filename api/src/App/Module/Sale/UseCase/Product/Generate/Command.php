<?php
namespace App\Module\Sale\UseCase\Product\Generate;


class Command
{

	/**
	* @var int
	*/
	private $count;


	public function __construct(int $count)
	{
		$this->count = $count;
	}


	public function getCount(): int
	{
		return $this->count;
	}
}