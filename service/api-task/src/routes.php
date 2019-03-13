<?php

$app->get('/healthcheck', function ($request, $response) {
	$this->logger->info("Service health check");
	return $response->withJson(["status" => "OK"], 200);
});

$app->group('/api/v1', function (\Slim\App $app) use ($validation) {
	$app->group('/store', function (\Slim\App $app) {
		$app->get('/products', \App\Domains\Store\StoreController::class);
	});
	$app->group('/users', function (\Slim\App $app) {
		$app->get('', \App\Domains\User\UserController::class);
		$app->get('/{id}', \App\Domains\User\UserController::class . ':data');
	});
});
