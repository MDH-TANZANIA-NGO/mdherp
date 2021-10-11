<?php
Route::group(['namespace' => 'User', 'middleware' => ['web', 'auth'], 'prefix' => 'users', 'as' => 'user.'], function () {
    Route::get('', 'UserController@index')->name('index');
    Route::get('create', 'UserController@create')->name('create');
});
