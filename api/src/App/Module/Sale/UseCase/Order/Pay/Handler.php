<?php
namespace App\Module\Sale\UseCase\Order\Pay;

use App\Module\Sale\Entity\Order;
use App\Dispatcher\EventDispatcher;
use App\Service\PaymentService;

class Handler
{

	/**
	* @var Order\OrderRepository
	*/
	private $orders;

	/**
	* @var PaymentService
	*/
	private $payment;

	/**
	* @var EventDispatcher
	*/
	private $eventDispatcher;


	public function __construct(Order\OrderRepository $orders,PaymentService $payment, EventDispatcher $eventDispatcher)
	{
		$this->orders = $orders;
		$this->payment = $payment;
		$this->eventDispatcher = $eventDispatcher;
	}


	/**
	 * @param Command $command
	 * @return int $id
	*/
	public function handle(Command $command): void
	{
        $order = $this->orders->getById($command->getId());
        
        $order->pay(new Order\Cost($command->getSum()));

        $this->payment->pay($order->getId(),$command->getSum());

        $order->confirmPay();

        $this->orders->save($order);

        $this->eventDispatcher->dispatchAll($order->releaseEvents());
	}

}