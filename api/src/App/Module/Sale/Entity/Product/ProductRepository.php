<?php
namespace App\Module\Sale\Entity\Product;

use Doctrine\ORM\EntityManager;
use App\Module\Sale\Entity\Exception\NotFoundEntityException;

class ProductRepository
{

	private $em;

	private $repository;

	public function __construct(EntityManager $em)
	{
		$this->em = $em;
		$this->repository = $em->getRepository(Product::class);
	}

	public function getById(int $id): Product
	{
		$product = $this->findById($id);

        if(!$product){
            throw new NotFoundEntityException('Product not found.');
        }
        
        return $product;
	}

	public function findById(int $id): ?Product
	{
		return $this->repository->findOneBy(['id'=>$id]) ?: null;
	}

	public function add(Product $product): void
	{
		$this->em->persist($billing);
		$this->em->flush($billing);
	}

	public function save(Product $product): void
	{
		$this->em->flush($billing);
	}

	public function remove(Product $product): void
	{
		$this->em->remove($billing);
		$this->em->flush($billing);
	}
	
}