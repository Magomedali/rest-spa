<?php
declare(strict_types=1);
namespace App\Module\Sale\Fetcher\Order;

use Doctrine\DBAL\Connection;
use Doctrine\DBAL\FetchMode;

class OrderFetcher
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
	 * @param OrderFilter $filter
	 * @return OrderView[]
	*/
	public function list(OrderFilter $filter): array
	{
		$queryBuilder = $this->connection->createQueryBuilder();

		$stmt = $queryBuilder->select("id,created_at,cost,status")
					->from(self::tableName())
					->execute();

		$stmt->setFetchMode(FetchMode::CUSTOM_OBJECT, OrderView::class);

		return $stmt->fetchAll();
	}


	/**
	 * @return string
	*/
	public static function tableName(): string
	{
		return "orders";
	}

}