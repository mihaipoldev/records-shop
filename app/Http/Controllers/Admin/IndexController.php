<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Record;

class IndexController extends Controller
{
	public function getIndex()
	{
		// dd(Record::all());
		return view('admin.index', [
			'products' => Record::all(),
		]);
	}
}
