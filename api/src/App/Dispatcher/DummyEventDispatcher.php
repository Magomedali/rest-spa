<?php
declare(strict_types=1);
namespace App\Dispatcher;

class DummyEventDispatcher implements EventDispatcher
{

	public function dispatchAll(array $events):void
    {
        foreach ($events as $event) {
            
        }
    }


    public function dispatch($event):void
    {
        
    }
}