<?php
namespace App\Module\Sale\Entity\Product;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="products")
 */
class Product
{
	/**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;


    /**
     * @var Name 
     * @ORM\Column(type="Type\Product\Name")
     */
    private $name;


    /**
     * @var Price
     * @ORM\Column(type="Type\Product\Price")
     */
    private $price;


    public function __construct(Name $name, Price $price)
    {
        $this->name = $name;
        $this->price = $price;
    }


    public function getId(): int
    {
        return $this->id;
    }


    public function getName(): Name
    {
        return $this->name;
    }


    public function getPrice(): Price
    {
        return $this->Price;
    }

}