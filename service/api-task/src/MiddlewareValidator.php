<?php
namespace App;

use App\Validator\JsonSchemaValidator\Validator;
use Psr\Container\ContainerInterface;

class MiddlewareValidator
{
	protected $container;
	private $schema;
	private static $schemaMap = [
		"user" => [
			'path' => __DIR__ . '/../public/json-schema/user-schema.json',
			'definition' => "#definitions/User"
		],
		"store" => [
			'path' => __DIR__ . '/../public/json-schema/store-schema.json',
			'definition' => "#definitions/Product"
		],
		"transaction" => [
			'path' => __DIR__ . '/../public/json-schema/transaction-schema.json',
			'definition' => "#definitions/Transaction"
		],
	];

	// constructor receives container instance
	public function __construct(ContainerInterface $container, $type) {
		$this->container = $container;
		$this->schema = self::$schemaMap[$type];
	}

	/**
	 * middleware invokable class
	 *
	 * @param  \Psr\Http\Message\ServerRequestInterface $request  PSR7 request
	 * @param  \Psr\Http\Message\ResponseInterface      $response PSR7 response
	 * @param  callable                                 $next     Next middleware
	 *
	 * @return \Psr\Http\Message\ResponseInterface
	 */
	public function __invoke($request, $response, $next)
	{
		$data = $request->getParsedBody();
		$validator = new Validator($this->schema['path'], $this->schema['definition']);
		$validator->validate(json_encode($data));
		if (!$validator->isValid()) {
			return $response->withJson(
				['status' => 'validation_failed', 'errors' => $validator->getErrors()],
				400);
		}

		$response = $next($request, $response);

		return $response;
	}
}