<?php
use Zend\Diactoros\ServerRequestFactory;
use Zend\Diactoros\Response\JsonResponse;
use Zend\HttpHandlerRunner\Emitter\SapiEmitter;
use Psr\Http\Message\ServerRequestInterface;
use Aura\Router\RouterContainer;

use Infrastructure\Framework\Http\ApplicationFactory;

use App\Http\Action\Api\Product\GenerateAction;
use App\Http\Action\Api\Product\ListAction;
use App\Http\Action\Api\Product\BuyAction;


chdir(dirname(__DIR__));
require "vendor/autoload.php";

$app = (new ApplicationFactory())();

$app->get('list','/',new ListAction());
$app->get('generate','/generate',new GenerateAction());
$app->post('buy','/buy/{id}',new BuyAction(),['tokens'=>['id'=>'\d+']]);

$app->pipe(new \App\Http\Middleware\CredentialsMiddleware());
$app->pipe(new \Framework\Http\Middleware\RouteMiddleware($app->getRouter()));

$request = ServerRequestFactory::fromGlobals();
$response = $app->handle($request);

$emitter = new SapiEmitter();
$emitter->emit($response);
?>