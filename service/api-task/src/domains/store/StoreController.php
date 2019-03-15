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
	 * @return mixed
	 */
	public function __invoke($request, $response)
	{
		$this->logger->info("Getting all products");
		$data = Product::all();
		return $response->withJson($data, 200);
	}

	public function add($request, $response, $args)
	{
		$this->logger->info("Add new product");
		$data = Product::create($request->getParsedBody());
		return $response->withJson($data, 201);
	}
}