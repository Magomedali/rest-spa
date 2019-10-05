<?php
namespace App\Module\Sale\Fetcher\Product;


class ProductFilter
{	

	/**
	* @var int
	*/
	public $id;

	/**
	* @var string
	*/
	public $name;

	/**
	* @var timestamp int
	*/
	public $start_price;

	/**
	* @var timestamp int
	*/
	public $finish_price;

	/**
	* @var int
	*/
	public $limit;

	/**
	* @var int
	*/
	public $offset;
}