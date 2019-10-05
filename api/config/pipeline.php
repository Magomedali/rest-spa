<?php

use App\Http\Middleware;

/** @var \Framework\Http\Application $app */
$app->pipe(Middleware\CredentialsMiddleware::class);
$app->pipe(Framework\Http\Middleware\BodyParamsMiddleware::class);
$app->pipe(Framework\Http\Middleware\RouteMiddleware::class);
$app->pipe(Framework\Http\Middleware\DispatchMiddleware::class);