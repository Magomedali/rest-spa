<?php
namespace Fixtures;

use App\Module\Sale\Entity\Product;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\FixtureInterface;

class ProductFixture implements FixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $faker = \Faker\Factory::create();
        
        for ($i = 0; $i < 20; $i++) {
            $product = new Product\Product(
                new Product\Name($faker->name),
                new Product\Price($faker->randomNumber(5))
            );

            $manager->persist($product);
        }
        
        $manager->flush();
    }
}