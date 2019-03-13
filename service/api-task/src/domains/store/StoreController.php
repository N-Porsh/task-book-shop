<?php

namespace App\Domains\Store;

use Monolog\Logger;

class StoreController
{
	protected $logger;

	/**
	 * StoreController constructor.
	 * @param $logger
	 */
	public function __construct(Logger $logger)
	{
		$this->logger = $logger;
	}

	/**
	 * Get All products from the store
	 * @param $request
	 * @param $response
	 * @param $args
	 * @return mixed
	 */
	public function __invoke($request, $response, $args)
	{
		$this->logger->info("Getting all products");
		$product = new StoreModel();
		$data = $product->getProducts();

		return $response->withJson($data, 200);
	}

}