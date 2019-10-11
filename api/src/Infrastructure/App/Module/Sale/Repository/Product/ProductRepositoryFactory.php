<?php
namespace Infrastructure\App\Module\Sale\Repository\Product;

use Psr\Container\ContainerInterface;
use Doctrine\ORM\EntityManager;
use App\Module\Sale\Repository\Product\DoctrineProductRepository;

class ProductRepositoryFactory{


	public function __invoke(ContainerInterface $container)
	{
		return new DoctrineProductRepository($container->get(EntityManager::class));
	}
}