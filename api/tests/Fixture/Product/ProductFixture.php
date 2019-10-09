<?php
namespace Test\Fixture\Product;

use App\Module\Sale\Entity\Product;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\Persistence\ObjectManager;

class ProductFixture extends AbstractFixture
{

	private $product;

	public function load(ObjectManager $manager): void
    {
        $faker = \Faker\Factory::create();
        
        $product = new Product\Product(
            new Product\Name($faker->name),
            new Product\Price($faker->randomNumber(5))
        );

        $this->product = $product;

        $manager->persist($product);
        $manager->flush();
    }


    public function getProduct(): Product\Product
    {
    	return $this->product;
    }

}