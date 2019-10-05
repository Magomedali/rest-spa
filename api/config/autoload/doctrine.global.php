<?php

use App\Module\Sale\Entity\Product;
use App\Module\Sale\Entity\Order;
use Doctrine\DBAL\Connection;

return [
    'dependencies' => [
        'factories'  => [
            Doctrine\ORM\EntityManagerInterface::class => ContainerInteropDoctrine\EntityManagerFactory::class,
            Connection::class => ContainerInteropDoctrine\ConnectionFactory::class,
        ],
    ],
    'doctrine' => [
        'configuration' => [
            'orm_default' => [
                'result_cache' => 'filesystem',
                'metadata_cache' => 'filesystem',
                'query_cache' => 'filesystem',
                'hydration_cache' => 'filesystem',
            ],
        ],
        'connection' => [
            'orm_default' => [
                'driver_class' => \Doctrine\DBAL\Driver\PDOMySql\Driver::class,
                'pdo' => PDO::class
            ],
        ],
        'driver' => [
            'orm_default' => [
                'class' => Doctrine\Common\Persistence\Mapping\Driver\MappingDriverChain::class,
                'drivers' => [
                    'App\Module\Sale\Entity' => 'entities',
                ]

            ],
            'entities' => [
                'class' => Doctrine\ORM\Mapping\Driver\AnnotationDriver::class,
                'cache' => 'filesystem',
                'paths' => [
                    'src/App/Module/Sale/Entity/Product',
                    'src/App/Module/Sale/Entity/Order',
                ],
            ],
        ],
        'types'=>[
            Product\NameType::NAME => Product\NameType::class,
            Product\PriceType::NAME => Product\PriceType::class,
            Order\CostType::NAME => Order\CostType::class
        ],
        'cache' => [
            'filesystem' => [
                'class' => Doctrine\Common\Cache\FilesystemCache::class,
                'directory' => 'var/cache/doctrine',
            ],
        ],
    ],
];
