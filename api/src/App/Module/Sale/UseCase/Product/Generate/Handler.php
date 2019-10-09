<?php
declare(strict_types=1);
namespace App\Module\Sale\UseCase\Product\Generate;

use Doctrine\ORM\EntityManagerInterface;
use App\Module\Sale\Entity\Product;
use Faker\Generator;

class Handler
{

	/**
	* @var EntityManagerInterface
	*/
	private $manager;

	/**
	* @var Faker\Generator
	*/
	private $faker;


	public function __construct(EntityManagerInterface $manager,Generator $faker)
	{
		$this->manager = $manager;
		$this->faker = $faker;
	}


	/**
	 * @param Command
	*/
	public function handle(Command $command)
	{
        
        for ($i = 0; $i < $command->getCount(); $i++) {
            $product = new Product\Product(
                new Product\Name($this->faker->name),
                new Product\Price($this->faker->randomNumber(5))
            );

            $this->manager->persist($product);
        }
        
        $this->manager->flush();
	}
}