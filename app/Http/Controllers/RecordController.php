<?php

namespace App\Http\Controllers;

use App\Models\Record;

class RecordController extends Controller
{
	public function getList()
	{
		return view('shop.index');
	}

	public function getItem($id)
	{
		$record = Record::find($id);

		return view('shop.record', [
			'record' => $record,
		]);
	}

}
