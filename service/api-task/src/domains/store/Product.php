<?php

namespace App\Domains\Store;


use Illuminate\Database\Eloquent\Model;


class Product extends Model
{
	protected $table = 'products';

	protected $fillable = ['name', 'price', 'description', 'quantity'];
}