<?php


// FrontEnd Requests
Route::get('/', 'FrontEndController@index');

Auth::routes();

// BackEnd Requests
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/product/{id}', 'FrontEndController@viewProduct')->name('product');
