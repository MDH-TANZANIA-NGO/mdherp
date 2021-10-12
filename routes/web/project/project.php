<?php
Route::group(['namespace' => 'Project', 'middleware' => ['web', 'auth'], 'prefix' => 'projects', 'as' => 'project.'], function () {
    Route::get('', 'ProjectControllerController@index')->name('index');
    Route::post('store', 'ProjectControllerController@store')->name('store');
    Route::get('{project}/show', 'ProjectControllerController@show')->name('show');
    Route::put('{project}/update', 'ProjectControllerController@update')->name('update');
    Route::put('{project}/activate', 'ProjectControllerController@activate')->name('activate');
});
