<?php
declare(strict_types=1);
namespace App\Module\Sale\Fetcher\Order;


class OrderView
{
	/**
	* @var int
	*/
	public $id;

	/**
	* @var int
	*/
	public $created_at;

	/**
	* @var int
	*/
	public $cost;

	/**
	* @var int
	*/
	public $status;

	/**
	* @var ProductView[]
	*/
	public $products;
}