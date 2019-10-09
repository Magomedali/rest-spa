<?php
declare(strict_types=1);
namespace App\Module\Sale\Fetcher\Order;


class OrderFilter
{
	/**
	* @var int
	*/
	public $id;

	/**
	* @var timestamp int
	*/
	public $start_cost;

	/**
	* @var timestamp int
	*/
	public $finish_cost;
}