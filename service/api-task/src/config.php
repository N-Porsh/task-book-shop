<?php
return [
	'settings' => [
		'mode' => true,
		'displayErrorDetails' => true, // set to false in production
		'addContentLengthHeader' => false, // Allow the web server to send the content-length header

		// Database settings
		'db' => [
			'driver' => 'mysql',
			'host' => 'localhost',
			'database' => 'task_db',
			'username' => 'root',
			'password' => '12345678',
			'charset'   => 'utf8',
			'collation' => 'utf8_unicode_ci',
			'prefix'    => '',
		],

		// Monolog settings
		'logger' => [
			'name' => 'API Task',
			'level' => Monolog\Logger::DEBUG,
			'path' => __DIR__ . '/../logs/app.log',
		]
	],
];