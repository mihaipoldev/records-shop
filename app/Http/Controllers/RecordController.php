<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use App\Models\Artist;
use App\Models\Label;
use App\Models\Record;
use App\Models\Track;

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
