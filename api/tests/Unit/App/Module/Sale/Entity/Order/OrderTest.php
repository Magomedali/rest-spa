<?php
namespace Test\Unit\App\Module\Sale\Entity\Product;

use PHPUnit\Framework\TestCase;
use Test\Builder\Order\OrderBuilder;
use Test\Builder\Product\ProductBuilder;
use App\Module\Sale\Entity\Order;
use App\Module\Sale\Entity\Product;
use DateTimeImmutable;

class OrderTest extends TestCase
{


	public function testCreate()
	{

		$productBuilder = ProductBuilder::instance();

		$product1 = $this->createProductWithPrice(100);

		$product2 = $this->createProductWithPrice(250);

		$order = OrderBuilder::instance()
								->withProduct($product1)
								->withProduct($product2)
								->build();

		self::assertCount(2, $order->getProducts());
		self::assertTrue($order->isNew());
		self::assertFalse($order->isPaid());
		self::assertInstanceOf(DateTimeImmutable::class,$order->getCreatedDate());

		$cost = new Order\Cost($product1->getPrice()->getValue() + $product2->getPrice()->getValue());
		self::assertEquals($cost,$order->getCost());
	}



	public function testAddProducts()
	{
		$order = OrderBuilder::instance()->build();

		$product = $this->createProductWithPrice(250);

		self::assertCount(0, $order->getProducts());
		$order->addProduct($product);
		self::assertCount(1, $order->getProducts());
	}




	public function testOrderPay()
	{
		$order = OrderBuilder::instance()->build();

		$product = $this->createProductWithPrice(250);

		$order->addProduct($product);

		self::assertTrue($order->isNew());
		self::assertFalse($order->isPaid());

		$order->pay(new Order\Cost($product->getPrice()->getValue()));
		
		self::assertFalse($order->isNew());
		self::assertTrue($order->isPaid());
	}



	public function testOrderTryPayWithWrongSum()
	{
		$order = OrderBuilder::instance()->build();

		$product = $this->createProductWithPrice(250);

		$order->addProduct($product);

		$this->expectExceptionMessage('Sum is not equals with order cost!');
		$order->pay(new Order\Cost(300));
	}



	public function testOrderTryRepeatPay()
	{
		$order = OrderBuilder::instance()->build();

		$product = $this->createProductWithPrice(250);

		$order->addProduct($product);
		$order->pay(new Order\Cost(250));

		$this->expectExceptionMessage('Order is already paid!');
		$order->pay(new Order\Cost(250));
	}



	private function createProductWithPrice(int $price): Product\Product
	{
		return ProductBuilder::instance()
							->withName(new Product\Name("Example"))
							->withPrice(new Product\Price($price))
							->build();
	}

}