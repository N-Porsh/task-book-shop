<?php

namespace App\Domains\Transaction;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;


class Transaction extends Model
{
	protected $table = 'transactions';

	protected $fillable = ['user_id', 'product_id', 'status'];

	public static function findTransaction($id)
	{
		try {
			return self::findOrFail($id);
		} catch (ModelNotFoundException $e) {
			throw new ModelNotFoundException("Transaction Not found", 404);
		}
	}
}