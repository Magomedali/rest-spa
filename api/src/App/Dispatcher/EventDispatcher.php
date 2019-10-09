<?php
declare(strict_types=1);
namespace App\Dispatcher;


interface EventDispatcher
{
	public function dispatchAll(array $event):void;

	public function dispatch($event): void;
}