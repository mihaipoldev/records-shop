<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Models\Record;
use App\Models\Track;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

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

	public function ajaxSaveTracks(Request $request, $record_id) {
		$this->validate($request, [
			'tracks.*.name'   => 'required|max:255',
			'tracks.*.side'   => 'required|max:2',
			'tracks.*.length' => 'max:255',
			'tracks.*.bpm'    => 'max:3',
		]);

		$record = Record::find($record_id);

		$tracks_request = $request['tracks'];
		foreach($tracks_request as $id => $track_request) {
			$track = Track::find($id);

			$track->record_id = $record->id;
			$track->name = $track_request['name'];
			$track->side = $track_request['side'];
			$track->length = $track_request['length'];
			$track->bpm = $track_request['bpm'];
			$track->slug = Helper::slugify($track->name);
			$track->draft = false;

			if(Input::hasFile('tracks_' . $id . '_audio')) {
				$file = Input::file('tracks_' . $id . '_audio');
				$track->audio = Helper::uploadFileAndGetPath($file, 'records/' . $record->slug, $track->slug);
			}

			$track->update();
		}

		return redirect()->route('admin.records.edit', [
			'record_id' => $track->record->id,
		]);
	}

}
