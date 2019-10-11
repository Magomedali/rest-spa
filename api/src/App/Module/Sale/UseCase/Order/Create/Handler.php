<?php
declare(strict_types=1);
namespace App\Module\Sale\UseCase\Order\Create;


use App\Module\Sale\Entity\Order;
use App\Module\Sale\Entity\Product\ProductRepository;
use App\Dispatcher\EventDispatcher;

class Handler
{

	/**
	* @var Order\OrderRepository
	*/
	private $orders;

	/**
	* @var ProductRepository
	*/
	private $products;

	/**
	* @var EventDispatcher
	*/
	private $eventDispatcher;


	public function __construct(Order\OrderRepository $orders,ProductRepository $products, EventDispatcher $eventDispatcher)
	{
		$this->orders = $orders;
		$this->products = $products;
		$this->eventDispatcher = $eventDispatcher;
	}


	/**
	 * @param Command $command
	 * @return int $id
	*/
	public function handle(Command $command): int
	{

        $products = $this->products->getCollectionByIds($command->getIds());

        $order = new Order\Order($products);
        
        $this->orders->add($order);
        
        $this->eventDispatcher->dispatchAll($order->releaseEvents());

        return $order->getId();
	}

}