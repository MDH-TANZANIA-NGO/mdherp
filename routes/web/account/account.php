<?php
Route::group(['namespace' => 'Account', 'middleware' => ['web', 'auth'], 'prefix' => 'accounts', 'as' => 'account.'], function () {
    Route::get('', 'AccountController@index')->name('index');
    Route::get('create', 'AccountController@create')->name('create');
    Route::post('store', 'AccountController@store')->name('store');
    Route::get('{account}/profile', 'AccountController@profile')->name('profile');
    Route::put('{account}/update', 'AccountController@update')->name('update');

});
