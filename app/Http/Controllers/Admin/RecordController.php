<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Record;

class RecordController extends Controller
{
	public function getIndex() {
		return view('admin.index', [
			'products' => Record::orderBy('release_date', 'desc')->get(),
		]);
	}

	public function editor($id = null) {
		$record = null;

		if($id) {
			$record = Record::find($id);
		}

		if(!$record) {
			$record = new Record();
		}

		return view('admin.records.editor', [
			'record' => $record,
		]);
	}
}
