<?php

namespace App\Domains\User;


use Monolog\Logger;

class UserController
{
	protected $logger;

	/**
	 * UserController constructor.
	 * @param $logger
	 */
	public function __construct(Logger $logger)
	{
		$this->logger = $logger;
	}

	public function __invoke($request, $response)
	{
		$this->logger->info("Getting all users ");
		$data = Users::all();
		return $response->withJson($data, 200);
	}

	public function data($request, $response, $args)
	{
		$this->logger->info("Getting user information ");
		$data = Users::find($args['id']);
		return $response->withJson($data, 200);
	}
}