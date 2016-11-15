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

Route::get('/', function() {
	return view('shop.index');
});
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