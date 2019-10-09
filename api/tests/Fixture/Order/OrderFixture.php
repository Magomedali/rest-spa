<?php
namespace Test\Fixture\Order;

use App\Module\Sale\Entity\Order;
use App\Module\Sale\Entity\Product;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\Persistence\ObjectManager;

class OrderFixture extends AbstractFixture
{

	private $order;

	public function load(ObjectManager $manager): void
    {
        $faker = \Faker\Factory::create();
        
        $product = new Product\Product(
            new Product\Name($faker->name),
            new Product\Price($faker->randomNumber(5))
        );

        $order = new Order\Order(new ArrayCollection());
        $order->addProduct($product);
        
        $this->order = $order;

        $manager->persist($product);
        $manager->persist($order);
        $manager->flush();
    }


    public function getOrder(): Order\Order
    {
    	return $this->order;
    }

}