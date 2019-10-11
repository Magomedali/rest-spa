<?php
declare(strict_types=1);
namespace App\Module\Sale\Repository\Product;

use Doctrine\ORM\EntityManager;
use App\Module\Sale\Entity\Exception\NotFoundEntityException;
use App\Module\Sale\Entity\Product\Product;
use App\Module\Sale\Entity\Product\ProductRepository;

class DoctrineProductRepository implements ProductRepository
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
		$this->repository = $em->getRepository(Product::class);
	}

	/**
	* @param int $id
	* @return Product
	* @throws NotFoundEntityException
	*/
	public function getById(int $id): Product
	{
		$product = $this->findById($id);

        if(!$product){
            throw new NotFoundEntityException('Product not found.');
        }
        
        return $product;
	}

	/**
	* @param array<int> $ids
	* @return array
	*/
	public function getCollectionByIds(array $ids): array
	{
		$queryBuilder = $this->em->createQueryBuilder();

		$query = $queryBuilder->select(['p'])
						->from('App\Module\Sale\Entity\Product\Product','p')
						->where($queryBuilder->expr()->in('p.id',$ids))
						->getQuery();

		return $query->getResult();
	}

	/**
	* @param int $id
	* @return Product
	*/
	public function findById(int $id): ?Product
	{
		return $this->repository->find($id) ?: null;
	}


	/**
	* @param Product $order
	* @return void
	*/
	public function add(Product $product): void
	{
		$this->em->persist($product);
		$this->em->flush($product);
	}


	/**
	* @param Product $order
	* @return void
	*/
	public function save(Product $product): void
	{
		$this->em->flush($product);
	}


	/**
	* @param Product $order
	* @return void
	*/
	public function remove(Product $product): void
	{
		$this->em->remove($product);
		$this->em->flush($product);
	}
	
}