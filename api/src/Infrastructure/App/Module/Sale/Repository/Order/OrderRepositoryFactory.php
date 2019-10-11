<?php
namespace Infrastructure\App\Module\Sale\Repository\Order;

use Psr\Container\ContainerInterface;
use Doctrine\ORM\EntityManager;
use App\Module\Sale\Repository\Order\DoctrineOrderRepository;

class OrderRepositoryFactory{


	public function __invoke(ContainerInterface $container)
	{
		return new DoctrineOrderRepository($container->get(EntityManager::class));
	}
}