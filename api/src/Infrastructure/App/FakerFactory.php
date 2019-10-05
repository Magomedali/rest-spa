<?php
namespace Infrastructure\App;

use Psr\Container\ContainerInterface;

class FakerFactory
{
    public function __invoke(ContainerInterface $container)
    {
        return \Faker\Factory::create();
    }
}