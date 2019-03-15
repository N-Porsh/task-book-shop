<?php

$app->get('/healthcheck', function ($request, $response) {
	$this->logger->info("Service health check");
	return $response->withJson(["status" => "OK"], 200);
});

$app->group('/api/v1', function (\Slim\App $app) use ($validation) {
	$ci = $app->getContainer();

	$app->group('/store', function (\Slim\App $app) use ($ci) {
		$app->get('/products', \App\Domains\Store\StoreController::class);
		$app->post('/products', \App\Domains\Store\StoreController::class . ':add')->add(new \App\MiddlewareValidator($ci, 'store'));
	});

	$app->group('/users', function (\Slim\App $app) use ($ci){
		$app->get('', \App\Domains\User\UserController::class);
		$app->get('/{id}', \App\Domains\User\UserController::class . ':show');
		$app->put('/{id}', \App\Domains\User\UserController::class . ':update')->add(new \App\MiddlewareValidator($ci, 'user'));
		$app->post('', \App\Domains\User\UserController::class . ':register')->add(new \App\MiddlewareValidator($ci, 'user'));
		$app->delete('/{id}', \App\Domains\User\UserController::class . ':unregister');
		$app->post('/{id}/buy', \App\Domains\User\UserController::class . ':buy');
	});

	$app->group('/transactions', function (\Slim\App $app) {
		$app->get('', \App\Domains\Transaction\TransactionController::class);
		$app->get('/{id}', \App\Domains\Transaction\TransactionController::class . ':show');
		$app->get('/user/{id}', \App\Domains\Transaction\TransactionController::class . ':getUserTransactions');
	});
});
