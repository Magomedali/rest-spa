<?php
namespace App\Module\Sale\Entity\Product;

use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\StringType;


class PriceType extends StringType
{
	const NAME = 'Type\Product\Price';


    public function convertToDatabaseValue($value, AbstractPlatform $platform)
    {
        return $value->getValue();
    }


    public function convertToPHPValue($value, AbstractPlatform $platform)
    {
        return new Price($value);
    }


    public function getName(): string
    {
        return self::NAME;
    }
}