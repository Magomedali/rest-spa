<?php
namespace Test\Unit\App\Module\Sale\Entity\Product;

use PHPUnit\Framework\TestCase;
use Test\Builder\Product\ProductBuilder;
use App\Module\Sale\Entity\Product;

class ProductTest extends TestCase
{


	public function testCreate()
	{
		$product = ProductBuilder::instance()
								->withName($name = new Product\Name("Apple"))
								->withPrice($price = new Product\Price(1000))
								->build();
		
		self::assertEquals($name, $product->getName());
		self::assertEquals($price, $product->getPrice());
	}
}