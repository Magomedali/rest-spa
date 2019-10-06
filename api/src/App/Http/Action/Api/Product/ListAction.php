<?php
namespace App\Http\Action\Api\Product;

use Psr\Http\Server\RequestHandlerInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;
use Zend\Diactoros\Response\JsonResponse;

use App\Module\Sale\Fetcher\Product;

class ListAction implements RequestHandlerInterface
{

	private $fetcher;

	public function __construct(Product\ProductFetcher $fetcher)
	{
		$this->fetcher = $fetcher;
	}

	public function handle(ServerRequestInterface $request): ResponseInterface
	{
	
		$products = $this->fetcher->list(new Product\ProductFilter());
	
		return new JsonResponse($products,200);
	}

	public function __invoke(ServerRequestInterface $request): ResponseInterface
	{
		return $this->handle($request);
	}
}