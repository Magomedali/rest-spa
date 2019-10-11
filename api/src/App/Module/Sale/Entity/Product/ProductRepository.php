<?php
declare(strict_types=1);
namespace App\Module\Sale\Entity\Product;

use App\Module\Sale\Entity\Exception\NotFoundEntityException;

interface ProductRepository
{

	/**
	* @param int $id
	* @return Product
	* @throws NotFoundEntityException
	*/
	public function getById(int $id): Product;


	/**
	* @param array<int> $ids
	* @return array
	*/
	public function getCollectionByIds(array $ids): array;


	/**
	* @param int $id
	* @return Product
	*/
	public function findById(int $id): ?Product;


	/**
	* @param Product $order
	* @return void
	*/
	public function add(Product $product): void;


	/**
	* @param Product $order
	* @return void
	*/
	public function save(Product $product): void;


	/**
	* @param Product $order
	* @return void
	*/
	public function remove(Product $product): void;
	
}