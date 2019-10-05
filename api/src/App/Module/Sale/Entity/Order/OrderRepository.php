<?php
namespace App\Module\Sale\Entity\Order;

use Doctrine\ORM\EntityManager;
use App\Module\Sale\Entity\Exception\NotFoundEntityException;

class OrderRepository
{

	private $em;

	private $repository;

	public function __construct(EntityManager $em)
	{
		$this->em = $em;
		$this->repository = $em->getRepository(Order::class);
	}

	public function getById(int $id): Order
	{
		$order = $this->findById($id);

        if(!$order){
            throw new NotFoundEntityException('Order not found.');
        }
        
        return $order;
	}

	public function findById(int $id): ?Order
	{
		return $this->repository->findOneBy(['id'=>$id]) ?: null;
	}

	public function add(Order $order): void
	{
		$this->em->persist($order);
		$this->em->flush($order);
	}

	public function save(Order $order): void
	{
		$this->em->flush($order);
	}

	public function remove(Order $order): void
	{
		$this->em->remove($order);
		$this->em->flush($order);
	}
	
}