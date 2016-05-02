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

// homepage
Route::get('/', 'PagesController@home');

// about page
Route::get('/about', 'PagesController@about');

// test page - recap
Route::get('/test', 'PhotoController@load');

// testing open weather call
Route::get('/ow', 'WeatherController@load');
