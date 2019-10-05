<?php
namespace App\Module\Sale\Entity\Product;

use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\StringType;


class NameType extends StringType
{
	const NAME = 'Type\Product\Name';


    public function convertToDatabaseValue($value, AbstractPlatform $platform)
    {
        return (string)$value;
    }


    public function convertToPHPValue($value, AbstractPlatform $platform)
    {
        return new Name($value);
    }


    public function getName(): string
    {
        return self::NAME;
    }
}