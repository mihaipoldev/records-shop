<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Record extends Model
{
	protected $fillable = [
		'title'
	];

	public function artists()
	{
		return $this->belongsToMany('App\Models\Artist');
	}

	public function label()
	{
		return $this->belongsTo('App\Models\Label');
	}
}
