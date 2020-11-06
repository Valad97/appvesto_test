<?php

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['prefix' => 'v1', 'middleware' => ['api']], function () {

    // Comments
    Route::apiResource('comments', 'CommentController');
    Route::group(['prefix' => 'comments'], function () {
        Route::get('all_by_event/{event}', 'CommentController@all_by_event');
    });
    // Events
    Route::group(['prefix' => 'events'], function () {
        Route::get('', 'EventsController@getAll');
        Route::get('{event}', 'EventsController@getEvent')->name('event');
    });

});
