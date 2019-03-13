<?php

namespace App\Domains\Store;

use App\DbConnection;
use PDO;

class StoreModel extends DbConnection
{

	/**
	 * get All Products
	 * @return array
	 */
	public function getProducts()
	{
		$sql = "SELECT id, name, price FROM products";
		$query = $this->db->prepare($sql);
		$query->execute();

		return $query->fetchAll(PDO::FETCH_ASSOC);
	}
}