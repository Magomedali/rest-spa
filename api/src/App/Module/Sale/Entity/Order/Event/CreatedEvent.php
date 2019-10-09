<?php
declare(strict_types=1);
namespace App\Module\Sale\Entity\Order\Event;

use App\Module\Sale\Entity\Order\Order;

class CreatedEvent
{

	/**
	 * @var Order
	*/
	private $order;


	public function __construct(Order $order)
	{
		$this->order = $order;
	}
	

	public function getOrder(): Order
	{
		return $this->order;
	}
}