<?php


// FrontEnd Requests
	// Get Requests
	Route::get('/', 'FrontEndController@index');
	Route::get('/product/{id}', 'FrontEndController@viewProduct')->name('product');
	Route::get('/chat', 'FrontEndController@chat'); // dummy lang sa
	Route::get('/view-shop', 'FrontEndController@viewShop'); // dummy lang sa
	Route::get('/profile/{id}', 'FrontEndController@profile'); // dummy lang sa
	Route::get('/shop/{shop_url}', 'FrontEndController@shop');



	// Post Requests
	Route::post('/sign-up', 'FrontEndController@signUp')->name('sign-up');
	Route::post('/login-user', 'FrontEndController@loginUser')->name('login');

	Auth::routes();
	Route::get('login', function () {
		return redirect('/');
	});
	Route::get('register', function () {
		return redirect('/');
	});

// BackEnd Requests
	// Get Requests
	Route::get('/{url_name}', 'BackEndController@backendLandingPage');
	Route::get('/get-user/{id}', 'BackEndController@getUser');

	Route::post('/update-profile-field', 'BackEndController@updateProfileField');
	Route::post('/upload-profile-img', 'BackEndController@uploadProfileImg');
	Route::post('/upgrade-account', 'BackEndController@upgradeAccount');

	Route::middleware(['auth', 'super-admin'])->prefix('super-admin')->name('super-admin.')->group(function () {
		Route::get('/dashboard', 'BackEndController@dashboard');
		Route::get('/users', 'BackEndController@users');
		Route::get('/shops', 'BackEndController@shops');
		Route::get('/categories', 'BackEndController@categories');
		Route::get('/tags', 'BackEndController@tags');
		Route::get('/get-users', 'BackEndController@getUsers');
		Route::get('/get-shops', 'BackEndController@getShops');
		Route::get('/get-categories', 'BackEndController@getCategories');
		Route::get('/get-tags', 'BackEndController@getTags');

		Route::post('/new-category', 'BackEndController@newCategory');
		Route::post('/update-category', 'BackEndController@updateCategory');
		Route::post('/new-tag', 'BackEndController@newTag');
		Route::post('/update-tag', 'BackEndController@updateTag');
		Route::post('/approve-user-request', 'BackEndController@approveUserRequest');
	});	
	
	Route::middleware(['auth', 'user'])->prefix('user')->name('user.')->group(function () {

	});
	
	Route::middleware(['auth', 'user-premium'])->prefix('user-premium')->name('user-premium.')->group(function () {
		Route::get('/{url_name}/{shop_url}', 'BackEndController@myShop');

		Route::post('/create-shop', 'BackEndController@createShop');
		Route::post('/upload-shop-img', 'BackEndController@uploadShopIMG');
		Route::post('/get-my-shop/{id}', 'BackEndController@getMyShop');
		Route::post('/update-shop-desc', 'BackEndController@updateShopDesc');
	});