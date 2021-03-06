<?php
declare(strict_types=1);
namespace App\Module\Sale\Entity\Order;

use DateTimeImmutable;
use DomainException;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use App\Module\Sale\Entity\EventTrait;
use App\Module\Sale\Entity\Product\Product;

/**
 * @ORM\Entity
 * @ORM\Table(name="orders")
 */
class Order
{
    use EventTrait;
    
    private const STATUS_NEW  = 0;
    private const STATUS_PAID = 1;

	/**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;


    /**
     * @ORM\Column(type="datetime_immutable", name="created_at")
     */
    private $createdDate;


    /**
     * @var Cost
     * @ORM\Column(type="Type\Order\Cost")
     */
    private $cost;


    /**
     * @var Status
     * @ORM\Column(type="integer", length=16)
    */
    private $status;


    /**
    * @var ArrayCollection
    *
    * @ORM\ManyToMany(targetEntity="App\Module\Sale\Entity\Product\Product", fetch="LAZY")
    * @ORM\JoinTable(name="order_products", 
    *   joinColumns={@ORM\JoinColumn(name="order_id",referencedColumnName="id")},
    *   inverseJoinColumns={@ORM\JoinColumn(name="product_id", referencedColumnName="id")}
    * )
    */
    private $products;


    /**
     * @param ArrayCollection<Product> $products
    */
    public function __construct(ArrayCollection $products)
    {
        $this->createdDate = new DateTimeImmutable();
        $this->cost = new Cost(0);
        $this->status = self::STATUS_NEW;
        $this->products = new ArrayCollection();

        foreach ($products as $product) {
            $this->addProduct($product);
        }

        $this->recordEvent(new Event\CreatedEvent($this));
    }


    /**
    * @return int $id
    */
    public function getId(): int
    {
        return $this->id;
    }


    /**
    * @return DateTimeImmutable $createdDate
    */
    public function getCreatedDate(): DateTimeImmutable
    {
        return $this->createdDate;
    }

    /**
    * @return Cost $cost
    */
    public function getCost(): Cost
    {
        return $this->cost;
    }


    /**
    * @return boolean
    */
    public function isNew(): bool
    {
        return $this->status === self::STATUS_NEW;
    }


    /**
    * @return boolean
    */
    public function isPaid(): bool
    {
        return $this->status === self::STATUS_PAID;
    }


    /**
    * @return Product[]
    */
    public function getProducts():array
    {
        return $this->products->toArray();
    }


    /**
     * @param Product $product
     * @return void
    */
    public function addProduct(Product $product): void
    {
        $this->products->add($product);

        $this->cost = new Cost($this->cost->getValue() + $product->getPrice()->getValue());
    }

    /**
     * @param Cost $sum
     * @return void
    */
    public function pay(Cost $sum): void
    {
        if(!$this->isNew())
        {
            throw new DomainException('Order is already paid!');
        }

        if(!$this->getCost()->isEqual($sum))
        {
            throw new DomainException('Sum is not equals with order cost!');
        }

        $this->status = self::STATUS_PAID;

        $this->recordEvent(new Event\PaidEvent($this));
    }

}