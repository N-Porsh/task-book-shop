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
		$data = User::all();
		return $response->withJson($data, 200);
	}

	public function show($request, $response, $args)
	{
		$this->logger->info("Getting user information");
		try {
			$user = User::findUser($args['id']);
			return $response->withJson($user, 200);
		} catch (\Exception $e) {
			return $response->withJson(['status' => $e->getMessage()], $e->getCode());
		}
	}

	public function register($request, $response, $args)
	{
		$this->logger->info("Creating new user ");
		$data = User::create($request->getParsedBody());
		return $response->withJson($data, 201);
	}

	public function unregister($request, $response, $args)
	{
		$this->logger->info("Delete user");
		$deleted = User::destroy($args['id']);
		if (!$deleted) {
			return $response->withJson(['status' => 'Nothing was deleted']);
		}
		return $response->withStatus(200);
	}

	public function update($request, $response, $args)
	{
		$this->logger->info("Getting user information");
		try {
			$user = User::findUser($args['id']);
			$this->logger->info("Updating user details");
			$user->update($request->getParsedBody());
			return $response->withJson($user, 200);
		} catch (\Exception $e) {
			return $response->withJson(['status' => $e->getMessage()], $e->getCode());
		}
	}

	public function buy($request, $response, $args)
	{
		$data = $request->getParsedBody();
		try {
			User::buyItems($args['id'], $data['products']);
		} catch (\Exception $e) {
			return $response->withJson(['status' => $e->getMessage()], $e->getCode());
		}

	}
}