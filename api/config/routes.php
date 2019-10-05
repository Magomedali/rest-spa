<?php
use App\Http\Action\Api;

/** @var \Framework\Http\Application $app */
$app->get('list','/',Api\Product\ListAction::class);
$app->get('generate','/generate',Api\Product\GenerateAction::class);
$app->post('buy','/buy/{id}',Api\Product\BuyAction::class,['tokens'=>['id'=>'\d+']]);