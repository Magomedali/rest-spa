<?php
namespace Infrastructure\Framework\Http\Middleware\ErrorHandler;

use Framework\Template\TemplateRenderer;
use Psr\Container\ContainerInterface;
use Zend\Diactoros\Response;

class PrettyErrorResponseGeneratorFactory
{
    public function __invoke(ContainerInterface $container)
    {
        return new PrettyErrorResponseGenerator(new Response());
    }
}