<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Label extends Model
{
	use SoftDeletes;

	protected $fillable = [
		'name',
		'slug',
	];

	protected $dates = ['deleted_at'];

	public function records()
	{
		return $this->hasMany('App\Models\Record');
	}

	public function __toString()
	{
		return $this->name;
	}
}
