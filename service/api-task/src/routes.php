<?php

$app->get('/healthcheck', function ($request, $response) {
	$this->logger->info("Service health check");
	return $response->withJson(["status"=> "OK"], 200);
});