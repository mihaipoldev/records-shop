<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Track extends Model
{
	public function record()
	{
		return $this->belongsTo('App\Models\Record');
	}
}
