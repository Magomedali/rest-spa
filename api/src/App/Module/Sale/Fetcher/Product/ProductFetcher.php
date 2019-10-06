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


	/**
	 * @param ProductFilter $filter
	 * @return ProductView[]
	*/
	public function list(ProductFilter $filter): array
	{
		$queryBuilder = $this->connection->createQueryBuilder();

		$stmt = $queryBuilder->select("*")
					->from(self::tableName())
					->orderBy('id','DESC')
					->execute();

		$stmt->setFetchMode(FetchMode::CUSTOM_OBJECT, ProductView::class);

		return $stmt->fetchAll();
	}


	/**
	 * @return string
	*/
	public static function tableName(): string
	{
		return "products";
	}

}