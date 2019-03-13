<?php
$container = $app->getContainer();

//Global error handler
$container['errorHandler'] = function ($c) {
	return function ($request, $response, $exception) use ($c) {
		return $response->withJson([
			'status' => 'Something went wrong! Internal server Error',
			'error' => $exception->getMessage()
		], 500);
	};
};

//Override the default Not Found Handler after App
unset($container['notFoundHandler']);
$container['notFoundHandler'] = function ($c) {
	return function ($request, $response) use ($c) {
		$response = new \Slim\Http\Response(404);
		return $response->withJson(['error' => 'Incorrect route'], 404);
	};
};


// Service factory for the ORM
$capsule = new \Illuminate\Database\Capsule\Manager;
$capsule->addConnection($container['settings']['db']);
$capsule->setAsGlobal();
$capsule->bootEloquent();
$container['db'] = function () use ($capsule){
	return $capsule;
};

$container['logger'] = function ($c) {
	$settings = $c->get('settings')['logger'];
	$logger = new Monolog\Logger($settings['name']);
	$logger->pushProcessor(new Monolog\Processor\UidProcessor());
	$logger->pushHandler(new Monolog\Handler\StreamHandler($settings['path'], $settings['level']));
	return $logger;
};

/** Controllers: **/
$container['App\Domains\Store\StoreController'] = function ($c) {
	return new \App\Domains\Store\StoreController($c['logger']);
};

$container['App\Domains\User\UserController'] = function ($c) {
	return new \App\Domains\User\UserController($c['logger']);
};

