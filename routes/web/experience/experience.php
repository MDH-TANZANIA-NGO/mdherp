<?php
Route::group(['namespace' => 'Experience', 'middleware' => ['web', 'auth'], 'prefix' => 'experiences', 'as' => 'experience.'], function () {
    Route::get('', 'ExperienceController@index')->name('index');
    Route::get('create', 'ExperienceController@create')->name('create');
    Route::post('store', 'ExperienceController@store')->name('store');
    Route::get('{experience}/show', 'ExperienceController@show')->name('show');
    Route::put('{experience}/update', 'ExperienceController@update')->name('update');

    Route::group(['prefix' => 'datatable', 'as' => 'datatable.'], function () {
        Route::get('all', 'ExperienceController@allDatatable')->name('all');
    });

});
