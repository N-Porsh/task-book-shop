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
		$this->logger->info("Getting user information ");
		$data = User::find($args['id']);
		return $response->withJson($data, 200);
	}

	public function register($request, $response, $args)
	{
		$this->logger->info("Creating new user ");
		$req = $request->getParsedBody();
		$data = User::create(['username' => $req['username'], 'email' => $req['email'], 'password' => $req['password']]);
		return $response->withJson($data, 201);
	}

	public function unregister($request, $response, $args)
	{
		$this->logger->info("Delete user");
		User::destroy($args['id']);
		return $response->withJson(null, 200);
	}

	public function update($request, $response, $args)
	{
		$this->logger->info("Updating user details");
	}
}