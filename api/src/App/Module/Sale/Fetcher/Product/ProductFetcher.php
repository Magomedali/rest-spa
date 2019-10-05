<?php
namespace App\Module\Sale\Fetcher\Product;

use Doctrine\DBAL\Connection;
use Doctrine\DBAL\FetchMode;

class ProductFetcher
{

	/**
	* @var Connection
	*/
	private $connection;


	public function __construct(Connection $connection)
	{
		$this->connection = $connection;
	}



	public function list(ProductFilter $filter): array
	{
		$queryBuilder = $this->connection->createQueryBuilder();

		$stmt = $queryBuilder->select("*")
					->from(self::tableName())
					->execute();

		$stmt->setFetchMode(FetchMode::CUSTOM_OBJECT, ProductView::class);

		return $stmt->fetchAll();
	}

	public static function tableName(): string
	{
		return "products";
	}

}