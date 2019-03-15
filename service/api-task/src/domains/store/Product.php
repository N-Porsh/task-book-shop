<?php

namespace App\Domains\Store;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;


class Product extends Model
{
	protected $table = 'products';

	protected $fillable = ['name', 'price', 'description'];

	public static function findProduct($id)
	{
		try {
			return self::findOrFail($id);
		} catch (ModelNotFoundException $e) {
			throw new ModelNotFoundException("Product Not found", 404);
		}
	}
}