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

use App\Models\Track;

Route::get('/', function() {
	return view('shop.index');
})->name('index');
Route::get('/login', function() {
	return view('user.login');
});
Route::get('/record-image/{title}', function($title) {
	$file = Storage::disk('local')->get('records/' . $title . '/side-a.jpg');

	return new Illuminate\Http\Response($file, 200);
})->name('record.image');

Route::get('/record/{id}', function($id) {
	return view('shop.record', ['record'=>\App\Models\Record::find($id)]);
})->name('record');

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
	foreach ($array as $key => $value){
		$array[$key] = intval(round($value));
	}
	// dd($array);die;

	return view('shop.record-analyser', ['track'=>$track, 'array'=>$array]);
})->name('record.analyser.player');