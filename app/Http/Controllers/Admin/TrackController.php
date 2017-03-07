<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Models\Track;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class TrackController extends Controller
{
	/**
	 * Ajax add a draft track or use an existing one
	 */
	public function add($record_id){
		$track = Track::where('draft', true)->first();
		// $track = Track::where('draft', true)->whereDay('updated_at', '!=', date('d'))->first();

		if(!$track) {
			$track = new Track();
			$track->draft = true;
		}

		$track->record_id = $record_id;
		$track->save();

		return redirect()->route('ajax.admin.track.save', [
			'track_id' => $track->id,
		]);
	}

	/**
	 * Ajax track editor
	 *
	 * @param Request $request
	 * @param $track_id
	 * @return RedirectResponse
	 */
	public function ajaxEditor(Request $request, $track_id) {
		$track = Track::find($track_id);

		return view('admin.records.tracks.editor', [
			'track' => $track,
			'index' => 10,
		]);
	}

	/**
	 * Ajax save track
	 *
	 * @param Request $request
	 * @param $track_id
	 * @return RedirectResponse
	 */
	public function ajaxSave(Request $request, $track_id, $record_id = null) {
		$this->validate($request, [
			'tracks.*.name'   => 'required|max:255',
			'tracks.*.side'   => 'required|max:2',
			'tracks.*.length' => 'max:255',
			'tracks.*.bpm'    => 'max:3',
		]);

		$track = Track::find($track_id);

		$track->fill([
			'name'   => $request['tracks'][$track_id]['name'],
			'side'   => $request['tracks'][$track_id]['side'],
			'length' => $request['tracks'][$track_id]['length'],
			'bpm'    => $request['tracks'][$track_id]['bpm'],
		]);

		if(!$track->slug){
			Helper::slugify($track->name);
			$track->draft = false;
		}

		return redirect()->route('admin.records.edit', [
			'record_id' => $track->record->id,
		]);
	}

}
