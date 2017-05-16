<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Models\Artist;
use App\Models\Color;
use App\Models\Record;
use App\Models\Track;
use ColorThief\ColorThief;
use File;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class RecordController extends Controller
{
	/**
	 * Items List
	 *
	 * @return View
	 */
	public function items() {
		return view('admin.index', [
			'products' => Record::orderBy('release_date', 'desc')->get(),
		]);
	}

	/**
	 * Add (Draft)
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

		return redirect()->route('admin.record.editor', [
			'record_id' => $record->id,
		]);
	}

	/**
	 * Editor
	 *
	 * @return View
	 */
	public function editor($record_id) {
		$record = Record::find($record_id);

		return view('admin.records.editor', [
			'record' => $record,
		]);
	}

	/**
	 * Save
	 *
	 * @param Request $request
	 * @param $record_id
	 * @return RedirectResponse
	 */
	public function save(Request $request, $record_id) {
		$record = Record::find($record_id);

		$record->fill([
			'name'         => $request['name'],
			'label_id'     => $request['label_id'],
			'release_date' => $request['release_date'],
			'catalog'      => $request['catalog'],
			'format'       => $request['format'],
			'description'  => $request['description'],
			'price'        => $request['price'],
			'stock'        => $request['stock'],
		]);

		if(!$record->slug) {
			$record->slug = Helper::slugify($record->name . '-' . $record->id);
		}

		/** artists part */
		$recordArtists = $request['artists'];
		if(!isset($recordArtists)) {
			$recordArtists = [];
		}
		foreach($record->artists as $artist) {
			if(!in_array($artist->id, $recordArtists)) {
				$record->artists()->detach($artist->id);
			}
		}
		foreach($recordArtists as $artistId) {
			if(!$record->artists->contains(Artist::find($artistId))) {
				$record->artists()->attach($artistId);
			}
		}

		$record->draft = false;
		$record->update();

		return redirect()->route('admin.record.editor', [
			'record_id' => $record->id,
		]);
	}

	/**
	 * Save Tracks
	 *
	 * @param Request $request
	 * @param $record_id
	 * @return RedirectResponse
	 */
	public function saveTracks(Request $request, $record_id) {
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

			$track->fill([
				'record_id' => $record->id,
				'name'      => $track_request['name'],
				'side'      => $track_request['side'],
				'length'    => $track_request['length'],
				'bpm'       => $track_request['bpm'],
				'slug'      => Helper::slugify($track->name), // todo
			]);

			/** artists part */
			if(!isset($track_request['artists'])) {
				$track_request['artists'] = [];
			}
			foreach($track->artists as $artist) {
				if(!in_array($artist->id, $track_request['artists'])) {
					$track->artists()->detach($artist->id);
				}
			}
			foreach($track_request['artists'] as $artistId) {
				if(!$track->artists()->where('artist_id', $artistId)->first()) {
					$track->artists()->attach($artistId);
				}
			}

			if(Input::hasFile('tracks_' . $id . '_audio')) {
				$file = Input::file('tracks_' . $id . '_audio');
				$track->audio = Helper::uploadFileAndGetPath($file, 'records/' . $record->slug, $track->slug);
			}

			$track->draft = false;
			$track->update();
		}

		return redirect()->route('admin.records.edit', [
			'record_id' => $track->record->id,
		]);
	}


	/**
	 * Save Image
	 *
	 * @param Request $request
	 * @param $record_id
	 * @return View
	 */
	public function saveImage(Request $request, $record_id) {
		$record = Record::find($record_id);

		File::delete(public_path($record->image));

		$imageFile = is_array($request->file('image')) ? $request->file('image')[0] : $request->file('image');
		$record->image = Helper::uploadFileAndGetPath($imageFile, 'records/' . $record->slug, 'image');

		$record->save();

		return asset($record->image);
	}


	/**
	 * Colors
	 *
	 * @param $request
	 * @param $record_id
	 * @return View
	 */
	public static function colors(Request $request, $record_id) {
		$record = Record::find($record_id);

		$imagePath = public_path() . '/' . $record->image;
		$colorsPlates = ColorThief::getPalette($imagePath, 5, 7);

		$colors = [
			'background' => [],
			'wave' => [],
		];
		foreach($colorsPlates as $color){
			$colors['background'][] = Helper::rgbaToHex('rgba(' . $color[0] . ',' . $color[1] . ',' . $color[2] . ', 0.5)');
			$colors['wave'][] = Helper::rgbaToHex('rgba(' . $color[0] . ',' . $color[1] . ',' . $color[2] . ', 0.8)');
		}

		return view('admin.records.colors', [
			'record' => $record,
			'colors' => $colors,
		]);
	}


	/**
	 * Save Colors
	 *
	 * @param $request
	 * @param $record_id
	 * @return string
	 */
	public static function saveColors(Request $request, $record_id) {
		$record = Record::find($record_id);

		if(!$record->color){
			$record->color()->associate(Color::create([]));
			$record->update();
		}

		$record->color->wave = Helper::toHex($request['wave']);
		$record->color->background_left = Helper::toHex($request['background-left']);
		$record->color->background_right = Helper::toHex($request['background-right']);
		$record->color->update();

		return 'true';
	}
}
