<?php
use App\Http\Action\Api;

/** @var \Framework\Http\Application $app */
$app->get('list','/',Api\Product\ListAction::class);
$app->put('generate','/product',Api\Product\GenerateAction::class);
$app->put('order','/order',Api\Order\CreateAction::class);
$app->post('pay','/pay',Api\Order\PayAction::class);