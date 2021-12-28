<?php
Route::group(['namespace' => 'Safari', 'middleware' => ['web', 'auth'], 'prefix' => 'safari', 'as' => 'safari.'], function () {
    Route::get('', 'SafariController@index')->name('index');
    Route::get('{safariAdvance}/create', 'SafariController@create')->name('create');
    Route::get('initiate', 'SafariController@initiate')->name('initiate');
    Route::post('store', 'SafariController@store')->name('store');
    Route::post('{uuid}/update', 'SafariController@update')->name('update');


});
