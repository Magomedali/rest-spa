<?php
namespace Test\Builder\Order;

use App\Module\Sale\Entity\Order;
use App\Module\Sale\Entity\Product\Product;
use Doctrine\Common\Collections\ArrayCollection;


class OrderBuilder
{
	
	/**
	* @var ArrayCollection
	*/
	private $products;


	public function __construct()
	{
		$this->products = new ArrayCollection();
	}


	public static function instance(): self
	{
		return new self();
	}


	public function withProducts(ArrayCollection $products): self
	{
		$clone = clone $this;
		$clone->products = $products;
		return $clone;
	}

	public function withProduct(Product $product): self
	{
		$clone = clone $this;
		$clone->products->add($product);
		return $clone;
	}

	public function build(): Order\Order
	{
		return new Order\Order($this->products);
	}

}