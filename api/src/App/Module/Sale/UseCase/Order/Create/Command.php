<?php
namespace App\Module\Sale\UseCase\Order\Create;


class Command
{

	/**
	* @var int[] $id
	*/
	private $ids;


	public function __construct(array $ids)
	{
		if(empty($ids))
		{
			throw new \InvalidArgumentException("Products ids are empty");
		}

		$this->ids = $ids;
	}


	public function getIds(): array
	{
		return $this->ids;
	}
}