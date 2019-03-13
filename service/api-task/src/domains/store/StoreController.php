<?php

namespace App\Domains\Store;

use Monolog\Logger;

class StoreController
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
}