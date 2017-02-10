<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Record;

class RecordController extends Controller
{
	public function getIndex()
	{
		return view('admin.index', [
			'products' => Record::all(),
		]);
	}

	public function getAdd()
	{
		return view('admin.records.add');
	}

	public function getEdit($id)
	{
		return view('admin.records.edit', [
			'record'=>Record::find($id)
		]);
	}
}
