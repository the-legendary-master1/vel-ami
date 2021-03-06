<?php


// FrontEnd Requests
	// Get Requests
	Route::get('/', 'FrontEndController@index');
	Route::get('/product/{name}/{id}', 'FrontEndController@viewProduct')->name('product');
	// Route::get('/chat', 'FrontEndController@chat'); // dummy lang sa
	Route::get('/view-shop/{shopName}', 'FrontEndController@viewShop'); // dummy lang sa
	Route::get('/profile/{id}', 'FrontEndController@profile'); // dummy lang sa
	Route::get('/shop/{shop_url}/{id}', 'FrontEndController@shop');
	Route::get('/get-reviews/{id}', 'FrontEndController@getReviews');
	Route::get('/get-products', 'FrontEndController@getProducts');
	// Route::get('/chat-seller/{id}/{name}', 'FrontEndController@chat');

	// Chatting
	Route::get('/chat-seller/{name}/{id}', 'FrontEndController@chat');
	Route::post('/is-typing', 'FrontEndController@isTyping');
	Route::get('/check-user-status/{pId}/{ref}', 'FrontEndController@checkUserStatus');
	
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

	Route::post('/store-reply-review', 'FrontEndController@storeReplyReview');

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
		// Route::get('/reported-reviews', 'BackEndController@reportedReviews');

		Route::post('/new-category', 'BackEndController@newCategory');
		Route::post('/update-category', 'BackEndController@updateCategory');
		Route::post('/new-tag', 'BackEndController@newTag');
		Route::post('/update-tag', 'BackEndController@updateTag');
		Route::post('/approve-user-request', 'BackEndController@approveUserRequest');
		
		Route::post('/store-message', 'FrontEndController@storeMessage');
		Route::get('/get-messages', 'FrontEndController@getMessages');
		Route::post('/read-message', 'FrontEndController@readMessage');
		Route::post('/seen-message', 'FrontEndController@seenMessage');
	});	
	
	Route::middleware(['auth', 'user'])->prefix('user')->name('user.')->group(function () {
		Route::post('/store-user-review', 'FrontEndController@storeUserReview');
		Route::post('/report-review', 'FrontEndController@reportReview');

		Route::post('/store-message', 'FrontEndController@storeMessage');
		Route::get('/get-messages', 'FrontEndController@getMessages');
		Route::post('/read-message', 'FrontEndController@readMessage');
		Route::post('/seen-message', 'FrontEndController@seenMessage');
	});
	
	Route::middleware(['auth', 'user-premium'])->prefix('user-premium')->name('user-premium.')->group(function () {
		Route::get('/{url_name}/{shop_url}', 'BackEndController@myShop');

		Route::post('/create-shop', 'BackEndController@createShop');
		Route::post('/upload-shop-img', 'BackEndController@uploadShopIMG');
		Route::post('/get-my-shop/{id}', 'BackEndController@getMyShop');
		Route::post('/update-shop-desc', 'BackEndController@updateShopDesc');

		Route::get('/get-categories', 'BackEndController@getCategories');
		Route::get('/get-tags', 'BackEndController@getTags');
		Route::post('/store-product', 'FrontEndController@storeProduct');
		Route::get('/search-tags', 'FrontEndController@searchTags');
		Route::get('/selected-products', 'FrontEndController@selectedProducts');
		Route::post('/delete-selected-products', 'FrontEndController@deleteSelectedProducts');
		Route::post('/update-cover-photo', 'FrontEndController@updateCoverPhoto');
		Route::post('/store-user-review', 'FrontEndController@storeUserReview');
		Route::post('/report-review', 'FrontEndController@reportReview');

		Route::post('/store-message', 'FrontEndController@storeMessage');
		Route::get('/get-messages', 'FrontEndController@getMessages');
		Route::post('/read-message', 'FrontEndController@readMessage');
		Route::post('/seen-message', 'FrontEndController@seenMessage');
	});