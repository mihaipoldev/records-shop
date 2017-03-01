<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use App\Models\Record;
use ColorThief\ColorThief;

class RecordController extends Controller
{
	private $records = null;

	public function getList() {
		// $record = Record::find(1);
		// dd(Helper::slugify($record->name . '-' . $record->catalog));

		$records = Record::orderBy('release_date', 'desc')->get();

		return view('shop.index', [
			'records' => $records,
		]);
	}

	public function getItem($id) {
		$this->records = Record::orderBy('release_date', 'desc')->get();
		$record = Record::find($id);

		$record = Record::find($id);
		$imageFullPath = public_path() . '/' . $record->image;
		// dd($imageFullPath);
		$dominantColor = ColorThief::getPalette($imageFullPath, 5, 7);

		return view('shop.record', [
			'record'   => $record,
			'color'    => $dominantColor,
			'prevNext' => $this->_getPrevAndNextRecord($id),
		]);
	}

	private function _getPrevAndNextRecord($id) {
		foreach($this->records as $index => $record) {
			if($record->id == $id) {
				return [
					'prev' => $index ? $this->records[$index - 1] : null,
					'next' => $index != (sizeof($this->records)-1) ? $this->records[$index + 1] : null,
				];
			}
		}

		return null;
	}

	private function _getPrevRecord($id) {
		foreach($this->records as $index => $record) {
			if($record->id == $id) {
				return $this->records[$index - 1];
			}
		}
	}

}
