<?php
use Zend\Diactoros\ServerRequestFactory;
use Zend\Diactoros\Response\JsonResponse;
use Zend\HttpHandlerRunner\Emitter\SapiEmitter;
use Psr\Http\Message\ServerRequestInterface;
use Aura\Router\RouterContainer;

use Infrastructure\Framework\Http\ApplicationFactory;

use App\Http\Api\Product\GenerateAction;
use App\Http\Api\Product\ListAction;
use App\Http\Api\Product\BuyAction;


chdir(dirname(__DIR__));
require "vendor/autoload.php";

$request = ServerRequestFactory::fromGlobals();

$app = (new ApplicationFactory())();

$app->get('list','/',new ListAction());
$app->get('generate','/generate',new GenerateAction());
$app->post('buy','/buy/{id}',new BuyAction(),['tokens'=>['id'=>'\d+']]);

$response = $app->handle($request);

$emitter = new SapiEmitter();
$emitter->emit($response);
?>