<?php
Route::group(['namespace' => 'Designation', 'middleware' => ['web', 'auth'], 'prefix' => 'designation', 'as' => 'designation.'], function () {
    Route::get('', 'DesignationController@index')->name('index');
    Route::get('create', 'DesignationController@create')->name('create');
    Route::post('store', 'DesignationController@store')->name('store');


});
