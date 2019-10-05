<?php
namespace App\Module\Sale\Entity;


trait EventTrait
{

	private $events = [];


	protected function recordEvent($event): void
	{
		$this->events[] = $event;
	}


	public function releaseEvents()
	{
		$events = $this->events;
		
		$this->events = [];

		return $events;
	}
}