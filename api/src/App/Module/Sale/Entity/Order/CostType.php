<?php
declare(strict_types=1);
namespace App\Module\Sale\Entity\Order;

use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\IntegerType;


class CostType extends IntegerType
{
	const NAME = 'Type\Order\Cost';


    public function convertToDatabaseValue($value, AbstractPlatform $platform)
    {
        return $value->getValue();
    }


    public function convertToPHPValue($value, AbstractPlatform $platform)
    {
        return new Cost($value);
    }


    public function getName(): string
    {
        return self::NAME;
    }
}