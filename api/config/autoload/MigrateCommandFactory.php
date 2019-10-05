<?php
namespace Infrastructure\App\Doctrine\Factory;

use Doctrine\DBAL\Migrations\Provider\OrmSchemaProvider;
use Doctrine\DBAL\Migrations\Tools\Console\Command\MigrateCommand;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Psr\Container\ContainerInterface;

class MigrateCommandFactory
{
    public function __invoke(ContainerInterface $container)
    {
        return new MigrateCommand(
            new OrmSchemaProvider(
                $container->get(EntityManagerInterface::class)
            )
        );
    }
}