<?php
declare(strict_types=1);
namespace Test\Feature;

use Doctrine\Common\DataFixtures\Purger\ORMPurger;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;

class DbWebTestCase extends WebTestCase
{
    /**
     * @var EntityManagerInterface
     */
    private $em;
    

    protected function setUp(): void
    {
        parent::setUp();
        
        $this->em = $this->getContainer()->get(EntityManagerInterface::class);
        
    }


    protected function tearDown(): void
    {
        
        $purger = new ORMPurger($this->em);
        $purger->purge();

        parent::tearDown();
    }

}