<?php
namespace Infrastructure\Framework\Http\Router;

use Aura\Router\RouterContainer;
use Framework\Http\Router\AuraRouter;

class AuraRouterFactory
{
    public function __invoke()
    {
        return new AuraRouter(new RouterContainer());
    }
}