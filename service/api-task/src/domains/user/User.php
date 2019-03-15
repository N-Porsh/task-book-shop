<?php

namespace App\Domains\User;


use App\Domains\Store\Product;
use App\Domains\Transaction\Transaction;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;


class User extends Model
{

	protected $table = 'users';

	protected $fillable = ['username', 'password', 'email', 'name', 'surname', 'birth_date'];


	public static function findUser($id)
	{
		try {
			return self::findOrFail($id);
		} catch (ModelNotFoundException $e) {
			throw new ModelNotFoundException("User Not found", 404);
		}
	}

	public static function buyItems($userId, $data)
	{
		$arr = [];
		foreach ($data as $productId) {
			$product = Product::find($productId);
			if (!$product) {
				continue;
			}
			$arr[] = ['user_id'=> $userId, 'status'=> 'bought', 'product_id' => $productId];
		}
		if (empty($arr)) {
			throw new ModelNotFoundException("Products with the given Ids not found", 404);
		}
		Transaction::insert($arr);
	}
}