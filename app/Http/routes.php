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
 * Admin
 */
// Route::group(['middleware' => 'auth'], function() {
Route::group(['prefix' => '/admin'], function() {
	Route::get('/', [
		'uses' => 'Admin\IndexController@getIndex',
		'as'   => 'admin.index',
	]);

	Route::get('/records/add', [
		'uses' => 'Admin\RecordController@add',
		'as'   => 'admin.records.add',
	]);

	Route::get('/record/{id}', [
		'uses' => 'Admin\RecordController@editor',
		'as'   => 'admin.records.edit',
	])
	->where('id', '[0-9]+');


	/** track */
	Route::get('/track/add/to-{record_id}', [
		'uses' => 'Admin\TrackController@add',
		'as'   => 'ajax.admin.track.add',
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
	->where('track_id', '[0-9]+')
	->where('record_id', '[0-9]+');
});
// });


Route::get('/login', function() {
	return view('user.login');
});
Route::get('/record-image/{title}', function($title) {
	$file = Storage::disk('local')->get('records/' . $title . '/side-a.jpg');

	return new Illuminate\Http\Response($file, 200);
})->name('record.image');


use App\Models\Track;

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