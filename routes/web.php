<?php


// FrontEnd Requests
	// Get Requests
	Route::get('/', 'FrontEndController@index');
	Route::get('/product/{id}', 'FrontEndController@viewProduct')->name('product');

	// Post Requests
	Route::post('/sign-up', 'FrontEndController@signUp')->name('sign-up');

	Auth::routes();

// BackEnd Requests
	// Get Requests
	Route::get('/home', 'HomeController@index')->name('home');
