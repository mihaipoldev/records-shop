<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Artist extends Model
{
	protected $fillable = [
		'name'
	];

    public function records()
    {
    	return $this->belongsToMany('App\Models\Record');
    }

    public function toArray()
    {
	    return $this->name;
    }
}
