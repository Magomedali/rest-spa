<?php
use Zend\Diactoros\ServerRequestFactory;
use Zend\Diactoros\Response\JsonResponse;
use Zend\HttpHandlerRunner\Emitter\SapiEmitter;
use Psr\Http\Message\ServerRequestInterface;
use Aura\Router\RouterContainer;

use Framework\Http\Application;
use Framework\Http\Router\AuraRouter;


chdir(dirname(__DIR__));
require "vendor/autoload.php";

$request = ServerRequestFactory::fromGlobals();

$router = new AuraRouter(new RouterContainer());

$app = new Application($router);

$app->get('version','/',function(ServerRequestInterface $request){
	return new JsonResponse(['version'=>'1.0.0'],200);
});

$response = $app->handle($request);

$emitter = new SapiEmitter();
$emitter->emit($response);
?>