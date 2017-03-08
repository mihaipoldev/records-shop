<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Artist extends Model
{
	use SoftDeletes;

	protected $fillable = [
		'name',
		'band',
		'slug',
	];

	protected $dates = ['deleted_at'];

	public function bands() {
		return $this->belongsToMany('App\Models\Artist', 'band_artist', 'artist_id', 'band_id');
	}

	public function artists() {
		return $this->belongsToMany('App\Models\Artist', 'band_artist', 'band_id', 'artist_id');
	}

	public function records() {
		return $this->belongsToMany('App\Models\Record', 'record_artist')
			->withPivot('record_id', 'artist_id', 'remix', 'order');
	}

	public function tracks() {
		return $this->belongsToMany('App\Models\Track', 'track_artist')
			->withPivot('track_id', 'artist_id', 'remix', 'order');
	}

	public function __toString() {
		return $this->name;
	}
}
