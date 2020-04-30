<?php


// FrontEnd Requests
Route::get('/', 'FrontEndController@index');

Auth::routes();

// BackEnd Requests
Route::get('/home', 'HomeController@index')->name('home');
