<?php
declare(strict_types=1);
namespace App\Module\Sale\Repository\Order;

use Doctrine\ORM\EntityManager;
use App\Module\Sale\Entity\Exception\NotFoundEntityException;
use App\Module\Sale\Entity\Order\OrderRepository;
use App\Module\Sale\Entity\Order\Order;

class DoctrineOrderRepository implements OrderRepository
{

	/**
	* @var EntityManager
	*/
	private $em;

	/**
	* @var EntityRepository
	*/
	private $repository;

	public function __construct(EntityManager $em)
	{
		$this->em = $em;
		$this->repository = $em->getRepository(Order::class);
	}

	/**
	* @param int $id
	* @return Order
	* @throws NotFoundEntityException
	*/
	public function getById(int $id): Order
	{
		$order = $this->findById($id);

        if(!$order){
            throw new NotFoundEntityException('Order not found.');
        }
        
        return $order;
	}

	/**
	* @param int $id
	* @return Order|null
	*/
	public function findById(int $id): ?Order
	{
		return $this->repository->find($id) ?: null;
	}

	/**
	* @param Order $order
	* @return void
	*/
	public function add(Order $order): void
	{
		$this->em->persist($order);
		$this->em->flush($order);
	}

	/**
	* @param Order $order
	* @return void
	*/
	public function save(Order $order): void
	{
		$this->em->flush($order);
	}


	/**
	* @param Order $order
	* @return void
	*/
	public function remove(Order $order): void
	{
		$this->em->remove($order);
		$this->em->flush($order);
	}
	
}