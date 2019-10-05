<?php
namespace App\Module\Sale\UseCase\Product\Generate;

Use App\Module\Sale\Entity\Product;

class Handler
{

	/**
	* @var Product\ProductRepository
	*/
	private $repository;


	public function __construct(
		Product\ProductRepository $repository
	)
	{
		$this->repository = $repository;
	}


	public function handle(Command $command)
	{

	}
}