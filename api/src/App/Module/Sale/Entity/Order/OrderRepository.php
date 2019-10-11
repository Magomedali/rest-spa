<?php
declare(strict_types=1);
namespace App\Module\Sale\Entity\Order;

use App\Module\Sale\Entity\Exception\NotFoundEntityException;

interface OrderRepository
{

	/**
	* @param int $id
	* @return Order
	* @throws NotFoundEntityException
	**/
	public function getById(int $id): Order;


	/**
	* @param int $id
	* @return Order|null
	**/
	public function findById(int $id): ?Order;

	/**
	* @param Order $order
	* @return void
	**/
	public function add(Order $order): void;

	/**
	* @param Order $order
	* @return void
	**/
	public function save(Order $order): void;

	/**
	* @param Order $order
	* @return void
	**/
	public function remove(Order $order): void;
	
}