<?php
declare(strict_types=1);
namespace App\Module\Sale\Entity\Product;

use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\IntegerType;


class PriceType extends IntegerType
{
	const NAME = 'Type\Product\Price';


    public function convertToDatabaseValue($value, AbstractPlatform $platform)
    {
        return $value->getValue();
    }


    public function convertToPHPValue($value, AbstractPlatform $platform)
    {
        return new Price((int)$value);
    }


    public function getName(): string
    {
        return self::NAME;
    }
}