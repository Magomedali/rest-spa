<?php

use Framework\Http\Application;
use Framework\Http\Pipeline\MiddlewareResolver;
use Framework\Http\Router\Router;


return [
    'dependencies' => [
        'abstract_factories' => [
            Zend\ServiceManager\AbstractFactory\ReflectionBasedAbstractFactory::class,
        ],
        'factories' => [
            Application::class => Infrastructure\Framework\Http\ApplicationFactory::class,
            Router::class => Infrastructure\Framework\Http\Router\AuraRouterFactory::class,
            MiddlewareResolver::class => Infrastructure\Framework\Http\Pipeline\MiddlewareResolverFactory::class,
            Faker\Generator::class => Infrastructure\App\FakerFactory::class,
            App\Dispatcher\EventDispatcher::class => Infrastructure\App\Dispatcher\EventDispatcherFactory::class,
            App\Service\PaymentService::class => Infrastructure\App\Service\PaymentServiceFactory::class
        ]
    ],
    'debug' => false,
];