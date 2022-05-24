<?php
Route::group(['namespace' => 'Education', 'middleware' => ['web', 'auth'], 'prefix' => 'educations', 'as' => 'education.'], function () {
    Route::get('', 'EducationController@index')->name('index');
    Route::get('create', 'EducationController@create')->name('create');
    Route::post('store', 'EducationController@store')->name('store');
    Route::get('{education}/show', 'EducationController@show')->name('show');
    Route::put('{education}/update', 'EducationController@update')->name('update');

    Route::group(['prefix' => 'datatable', 'as' => 'datatable.'], function () {
        Route::get('all', 'EducationController@allDatatable')->name('all');
    });


});
