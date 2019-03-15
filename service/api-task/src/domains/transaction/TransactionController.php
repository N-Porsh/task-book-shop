<?php

namespace App\Domains\Transaction;

use Monolog\Logger;

class TransactionController
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
	 * Get All transactions
	 * @param $request
	 * @param $response
	 * @return mixed
	 */
	public function __invoke($request, $response)
	{
		$this->logger->info("Getting all transactions");
		$data = Transaction::all();
		return $response->withJson($data, 200);
	}

	/**
	 * Get transaction information
	 * @param $request
	 * @param $response
	 * @param $args
	 * @return mixed
	 */
	public function show($request, $response, $args)
	{
		$this->logger->info("Getting transaction information");
		try {
			$user = Transaction::findTransaction($args['id']);
			return $response->withJson($user, 200);
		} catch (\Exception $e) {
			return $response->withJson(['status' => $e->getMessage()], $e->getCode());
		}
	}

	public function getUserTransactions($request, $response, $args)
	{
		$data = Transaction::where('user_id', $args['id'])->get();
		if ($data->isEmpty()) {
			return $response->withJson(['status' => "No transactions found"], 404);
		}
		return $response->withJson($data, 200);
	}

}