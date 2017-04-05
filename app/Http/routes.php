<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

// Route::group(['middleware' => 'web'], function() {


/**
 * Redirect
 */
Route::get('/', function() {
	return redirect()->route('record.list');
});

/**
 * Records
 */
Route::group(['prefix' => '/records'], function() {
	Route::get('/', [
		'uses' => 'RecordController@getList',
		'as'   => 'record.list',
	]);

	Route::get('/{id}', [
		'uses' => 'RecordController@getItem',
		'as'   => 'record.item',
	]);
});


/**
 * Cart
 */
Route::get('add-to-cart/{record_id}', [
	'uses' => 'RecordController@addToCart',
	'as'   => 'record.add-to-cart',
]);

Route::get('shopping-cart', [
	'uses' => 'RecordController@shoppingCart',
	'as' => 'record.shopping-cart'
]);

Route::get('checkout', [
	'uses' => 'RecordController@checkout',
	'as' => 'checkout'
]);


/**
 * Admin
 */
// Route::group(['middleware' => 'auth'], function() {
Route::group(['prefix' => '/admin'], function() {

	/** record */
	Route::get('/records', [
		'uses' => 'Admin\RecordController@items',
		'as'   => 'admin.records',
	]);

	Route::get('/record/add', [
		'uses' => 'Admin\RecordController@add',
		'as'   => 'admin.record.add',
	]);

	Route::get('/record/{record_id}', [
		'uses' => 'Admin\RecordController@editor',
		'as'   => 'admin.record.editor',
	]);

	Route::post('/record/{record_id}/save', [
		'uses' => 'Admin\RecordController@save',
		'as'   => 'admin.record.save',
	]);

	Route::post('/record/{record_id}/save-image', [
		'uses' => 'Admin\RecordController@saveImage',
		'as'   => 'admin.record.save.image',
	]);

	Route::post('/record/{record_id}/save-tracks', [
		'uses' => 'Admin\RecordController@saveTracks',
		'as'   => 'admin.record.save-tracks',
	]);


	/** track */
	Route::get('/record/{record_id}/track/add', [
		'uses' => 'Admin\TrackController@add',
		'as'   => 'admin.record.track.add',
	]);




	Route::get('/track/{track_id}/save', [
		'uses' => 'Admin\TrackController@ajaxEditor',
		'as'   => 'ajax.admin.track.save',
	])
		->where('track_id', '[0-9]+');

	Route::post('/track/{track_id}/save', [
		'uses' => 'Admin\TrackController@ajaxSave',
		'as'   => 'ajax.admin.track.save',
	])
		->where('track_id', '[0-9]+');

	Route::get('/track-artists/{track_id}', [
		'uses' => 'Admin\TrackController@ajaxArtistList',
		'as'   => 'ajax.record.track.artists',
	]);

	/** START ___ Artists */
	Route::get('/artists', [
		'uses' => 'Admin\ArtistController@ajaxItems',
		'as'   => 'ajax.record.artists',
	]);

	Route::get('/artist/{artist_id?}', [
		'uses' => 'Admin\ArtistController@ajaxEditor',
		'as'   => 'ajax.record.artist.editor',
	]);

	Route::post('/artist-save/{artist_id?}', [
		'uses' => 'Admin\ArtistController@ajaxSave',
		'as'   => 'ajax.record.artist.save',
	]);

	Route::get('/artist-delete/{artist_id}', [
		'uses' => 'Admin\ArtistController@ajaxDelete',
		'as'   => 'ajax.record.artist.delete',
	]);
	/** END */

	/** Start ___ Labels */
	Route::get('/record/labels/{record_id?}', [
		'uses' => 'Admin\LabelController@items',
		'as'   => 'ajax.record.labels',
	]);

	Route::get('/label/{label_id?}', [
		'uses' => 'Admin\LabelController@editor',
		'as'   => 'ajax.record.label.editor',
	]);

	Route::post('/label-save/{label_id}', [
		'uses' => 'Admin\LabelController@save',
		'as'   => 'ajax.record.label.save',
	]);
	/** End */

	/** Start ___ Colors */
	Route::get('/record/{record_id}/colors}', [
		'uses' => 'Admin\RecordController@colors',
		'as'   => 'record.colors',
	]);

	Route::post('/record/{record_id}/save-colors', [
		'uses' => 'Admin\RecordController@saveColors',
		'as'   => 'record.save.colors',
	]);
	/** End */
});

Route::post('/save-image', function(Illuminate\Http\Request $request) {
	dd($request['src']);
})->name('save.image');
// });


Route::get('/login', function() {
	return view('user.login');
});
Route::get('/record-image/{title}', function($title) {
	$file = Storage::disk('local')->get('records/' . $title . '/side-a.jpg');

	return new Illuminate\Http\Response($file, 200);
})->name('record.image');


// use App\Models\Track;

Route::post('/record-analyser', function(\Illuminate\Http\Request $request) {
	$track = Track::where('title', 'Goneta')->first();
	$array = $request['array'];
	$track->player_analyser = $array;
	// dump($track);die;
	$track->update();

})->name('record.analyzer');

Route::get('/record-analyser/{id}', function($id) {
	$track = Track::where('title', 'Goneta')->first();
	$array = explode(' ', $track->player_analyser);
	foreach($array as $key => $value) {
		$array[$key] = intval(round($value));
	}

	// dd($array);die;

	return view('shop.record-analyser', ['track' => $track, 'array' => $array]);
})->name('record.analyser.player');

// });