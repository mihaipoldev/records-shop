<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Track extends Model
{
	use SoftDeletes;

	protected $fillable = [
		'name',
		'slug',
		'record_id',
		'side',
		'audio',
		'wave',
		'length',
		'bpm',
	];

	protected $dates = ['deleted_at'];

	public function record() {
		return $this->belongsTo('App\Models\Record');
	}

	public function artists() {
		return $this->belongsToMany('App\Models\Artist', 'track_artist')
			->withPivot('track_id', 'artist_id', 'remix', 'order');
	}

	public function artistsDisplay(){
		$display = '';
		foreach($this->artists as $index => $artist){
			if($index != 0){
				$display .= ', ';
			}
			$display .= $artist;
		}
		return $display;
	}

	public function __toString() {
		return $this->name ? $this->name : '';
	}
}
