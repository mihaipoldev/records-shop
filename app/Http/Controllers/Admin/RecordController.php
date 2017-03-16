<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Models\Artist;
use App\Models\Record;
use App\Models\Track;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
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

			/** artists part */
			if(!isset($track_request['artists'])){
				$track_request['artists'] = [];
			}
			foreach($track->artists as $artist){
				if(!in_array($artist->id, $track_request['artists'])){
					$track->artists()->detach($artist->id);
				}
			}
			foreach($track_request['artists'] as $artistId){
				if(!$track->artists()->where('artist_id', $artistId)->first()){
					$track->artists()->attach($artistId);
				}
			}

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


	/**
	 * Ajax save track
	 *
	 * @param Request $request
	 * @param $record_id
	 * @return RedirectResponse
	 */
	public function ajaxSave(Request $request, $record_id) {

		dd($request['artists']);

		$this->validate($request, [
			'tracks.*.name'   => 'required|max:255',
			'tracks.*.side'   => 'required|max:2',
			'tracks.*.length' => 'max:255',
			'tracks.*.bpm'    => 'max:3',
		]);

		$record = Record::find($record_id);

		$record->fill([
			'name'   => $request['tracks'][$record_id]['name'],
			'side'   => $request['tracks'][$record_id]['side'],
			'length' => $request['tracks'][$record_id]['length'],
			'bpm'    => $request['tracks'][$record_id]['bpm'],
		]);

		if(!$record->slug){
			Helper::slugify($record->name);
			$record->draft = false;
		}

		return redirect()->route('admin.records.edit', [
			'record_id' => $record->id,
		]);
	}
}
