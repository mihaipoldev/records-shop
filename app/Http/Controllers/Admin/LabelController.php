<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Artist;
use App\Models\Label;
use App\Models\Record;
use Illuminate\Http\Request;
use View;

class LabelController extends Controller
{
	/**
	 * Ajax - Items
	 *
	 * @return View
	 */
	public function items($record_id = null) {
		$labels = Label::where('draft', false)
			->orderBy('name')->get();

		$record = Record::find($record_id);

		return view('admin.records.labels.list', [
			'labels' => $labels,
			'record' => $record,
			// 'record' => null,
		]);
	}


	/**
	 * Ajax - Editor
	 *
	 * @param int|null $label_id
	 * @return View
	 */
	public function editor($label_id = null) {
		$label = Label::find($label_id);

		if(!$label) {
			$label = Label::where('draft', true)->first();
			if(!$label){
				$label = new Label();
				$label->draft = true;
				$label->save();
			}
		}

		return view('admin.records.labels.editor', [
			'label' => $label,
		]);
	}


	/**
	 * Ajax - Save artist
	 *
	 * @param Request $request
	 * @param int $artist_id
	 * @return View
	 */
	public function ajaxSave(Request $request, $artist_id = null) {
		$artist = Artist::find($artist_id);

		if(!$artist) {
			$artist = new Artist();
			$artist->save();
		}
		$artist->name = $request['name'];

		if(isset($request['is_band'])) {
			$artist->band = true;

			foreach($request['artists-band'] as $assocArtist) {
				$artist->artists()->attach([$assocArtist]);
			}
		}

		$artist->update();

		$artists = Artist::orderBy('name')->get();

		return view('admin.records.artists.list', [
			'artists' => $artists,
		]);
	}


	/**
	 * Ajax - Delete an artist
	 *
	 * @param int $artist_id
	 * @return string
	 */
	public function ajaxDelete($artist_id) {
		$artist = Artist::find($artist_id);
		$artist->delete();

		$artists = Artist::orderBy('name')->get();

		return view('admin.records.artists.list', [
			'artists' => $artists,
		]);
	}


}
