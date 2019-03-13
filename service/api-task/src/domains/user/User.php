<?php

namespace App\Domains\User;


use Illuminate\Database\Eloquent\Model;


class User extends Model
{

	protected $table = 'users';

	protected $fillable = ['username', 'email', 'password'];
}