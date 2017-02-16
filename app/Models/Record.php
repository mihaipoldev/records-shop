<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Record extends Model
{
	use SoftDeletes;

	protected $fillable = [
		'name',
		'slug',
		'release_date',
		'label_id',
		'catalog',
		'format',
		'description',
		'image',
		'price',
		'stock',
		'online',
	];

	protected $dates = ['deleted_at'];

	public function label()
	{
		return $this->belongsTo('App\Models\Label');
	}

	public function artists()
	{
		return $this->belongsToMany('App\Models\Artist', 'record_artist')
			->withPivot('record_id', 'artist_id', 'remix', 'order');
	}

	public function tracks()
	{
		return $this->hasMany('App\Models\Track');
	}

	public function __toString()
	{
		return $this->name;
	}
}
