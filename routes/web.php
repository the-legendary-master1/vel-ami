<?php


// FrontEnd Requests
Route::get('/', 'FrontEndController@index');
Route::post('/sign-up', 'FrontEndController@signUp')->name('sign-up');

Auth::routes();

// BackEnd Requests
Route::get('/home', 'HomeController@index')->name('home');
