<?php
namespace Infrastructure\App\Dispatcher;

use Psr\Container\ContainerInterface;
use App\Dispatcher\DummyEventDispatcher;

class EventDispatcherFactory
{
    public function __invoke(ContainerInterface $container)
    {
        return new DummyEventDispatcher();
    }
}