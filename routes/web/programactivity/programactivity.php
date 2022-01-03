<?php
Route::group(['namespace' => 'ProgramActivity', 'middleware' => ['web', 'auth'], 'prefix' => 'programactivity', 'as' => 'programactivity.'], function () {
    Route::get('', 'ProgramActivityController@index')->name('index');
    Route::get('initiate', 'ProgramActivityController@initiate')->name('initiate');
    Route::post('store', 'ProgramActivityController@store')->name('store');
    Route::get('{programActivity}/create', 'ProgramActivityController@create')->name('create');

});
