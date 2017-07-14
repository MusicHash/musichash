<?php

/**
 * Application Routes
 * 
*/

Route::get('/', [
    'as' => 'GOTO_HOMEPAGE',
    'uses' => 'IndexController@index'
]);
Route::get('/bp/{string}', 'IndexController@index');
Route::get('/login', 'LoginController@fbLogin'); // Regular login, creates user if doesnt exist.
Route::get('/api/beatport/chart/{string}', 'BeatPortController@chart');
Route::get('/api/beatport/genres', 'BeatPortController@genres');
Route::get('/api/youtube/search/{string}', 'YoutubeController@search');