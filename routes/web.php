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
	Route::get('/dashboard', 'BackEndController@dashboard');
	Route::get('/{url_name}', 'BackEndController@backendLandingPage');

	Route::middleware(['auth', 'super-admin'])->prefix('super-admin')->name('super-admin.')->group(function () {

	});	
	
	Route::middleware(['auth', 'user'])->prefix('user')->name('user.')->group(function () {

	});
	
	Route::middleware(['auth', 'user-premium'])->prefix('user-premium')->name('user-premium.')->group(function () {

	});