<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Artist;
use Illuminate\Http\Request;
use View;

class ArtistController extends Controller
{
	/**
	 * Ajax - Display the list of artists
	 *
	 * @return View
	 */
	public function ajaxItems() {
		$artists = Artist::orderBy('name')->get();

		return view('admin.records.artists.list', [
			'artists' => $artists,
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
	 * Ajax - Editor of artist
	 *
	 * @param int $artist_id
	 * @return View
	 */
	public function ajaxEditor($artist_id = null) {
		$artist = Artist::find($artist_id);

		return view('admin.records.artists.editor', [
			'artist' => $artist,
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
