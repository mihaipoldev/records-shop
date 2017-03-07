<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Request;
use App\Models\Record;
use App\Models\Track;
use Illuminate\Contracts\View\View;

class RecordController extends Controller
{
	public function getIndex() {
		return view('admin.index', [
			'products' => Record::orderBy('release_date', 'desc')->get(),
		]);
	}

	/**
	 * Add a DRAFT record in the database or use an existing one
	 *
	 * @return View
	 */
	public function add() {
		$record = Record::where('draft', true)->first();
		// $record = Record::where('draft', true)->whereDay('updated_at', '!=', date('d'))->first();
		if(!$record) {
			$record = new Record();
			$record->draft = true;
			$record->save();
		}

		return redirect()->route('admin.records.edit', [
			'id' => $record->id,
		]);
	}

	/**
	 * Editor
	 *
	 * @return View
	 */
	public function editor($id) {
		$record = Record::find($id);

		return view('admin.records.editor', [
			'record' => $record,
		]);
	}

}
