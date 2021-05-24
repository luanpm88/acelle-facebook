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

Route::group(['middleware' => ['web'], 'namespace' => '\Acelle\Plugin\Facebook\Controllers'], function () {
    // // Facebook setting page
    Route::match(['get'], '/facebook', 'MainController@index');
    // Route::match(['get'], '/facebook/edit-key', 'MainController@editKey');
    // Route::match(['get'], '/facebook/select-domain', 'MainController@selectDomain');
    // Route::match(['post'], '/facebook/save-key', 'MainController@saveKey');
    // Route::match(['post'], '/facebook/save-domain', 'MainController@saveDomain');
    Route::match(['post'], '/facebook/activate', 'MainController@activate');
    // Route::match(['post'], '/facebook/reset', 'MainController@reset');

    // // setting
    // Route::get('facebook/{uid}/popup', 'MainController@popup');
    // Route::match(['get', 'post'], 'facebook/{uid}/connection', 'MainController@connection');
    // Route::post('facebook/{uid}/turn-off', 'MainController@turnOff');
});
