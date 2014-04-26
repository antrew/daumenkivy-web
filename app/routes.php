<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/
Route::get ( '/', function () {
	// TODO sort ID descending
	$daumenkivys = Daumenkivy::all ();
	
	return View::make ( 'feed' )->with ( 'daumenkivys', $daumenkivys );
} );

Route::get ( '/submit', function () {
	return View::make ( 'submit_form' );
} );

Route::post ( '/submit', function () {
	$dk = new Daumenkivy();

	$dk->caption = Input::get('caption');
	$dk->username = Input::get('username');
	$dk->email = Input::get('email');

	// TODO move file to storage
	$file = Input::file('file');

	// TODO check if parameters are provided
	// insert into database
	$dk->save();

	return View::make ( 'submit_success' );
} );
