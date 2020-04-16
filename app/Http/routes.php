<?php

	Route::group(['middleware' => 'admin'], function () {
		Route::get('/admin','AdminController@index');

		Route::get('/admin/login','AdminController@login');

		Route::post ('/admin/login','AdminController@postLogin');
		
	});

	Route::group(['middleware' => 'web'], function () {
		Router::auth();

		Router::get('/home','HomeController@index');

		Router::get('/show-user','HomeController@index');

		Router::get('/', function(){
			return view('welcome');
		});
	});

	
