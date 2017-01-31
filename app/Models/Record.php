<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Record extends Model
{
	protected $fillable = [
		'title',
		'label_id',
		'catalog',
		'title',
		'title'
	];

	public function artists()
	{
		return $this->belongsToMany('App\Models\Artist');
	}

	public function tracks()
	{
		return $this->hasMany('App\Models\Track');
	}

	public function label()
	{
		return $this->belongsTo('App\Models\Label');
	}
}
