<?php
use Zend\Diactoros\ServerRequestFactory;
use Zend\HttpHandlerRunner\Emitter\SapiEmitter;
use Zend\Diactoros\Response\JsonResponse;

chdir(dirname(__DIR__));
require "vendor/autoload.php";

$request = ServerRequestFactory::fromGlobals();


$response = (new JsonResponse(['success'=>1]));

$emitter = new SapiEmitter();
$emitter->emit($response);
?>