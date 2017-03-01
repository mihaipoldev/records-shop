<?php

namespace App\Http\Controllers\Admin;

use ColorThief\ColorThief;

use App\Http\Controllers\Controller;
use App\Models\Record;

class IndexController extends Controller
{
	public function getIndex()
	{
		return view('admin.index', [
			'products' => Record::orderBy('release_date', 'desc')->get(),
		]);
	}
}
