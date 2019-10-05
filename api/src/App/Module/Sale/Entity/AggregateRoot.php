<?php
namespace App\Module\Sale\Entity;


interface AggregateRoot
{
	public function releaseEvents();
}