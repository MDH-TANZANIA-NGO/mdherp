<?php
Route::group(['namespace' => 'Retirement', 'middleware' => ['web', 'auth'], 'prefix' => 'retirement', 'as' => 'retirement.'], function () {
    Route::get('', 'RetirementController@index')->name('index');
    Route::get('create', 'RetirementController@create')->name('create');
//    Route::get('{retirement}/create', 'RetirementController@create')->name('create');
//    Route::get('{retirement}/edit', 'RetirementController@create')->name('edit');
    Route::get('initiate', 'RetirementController@initiate')->name('initiate');



});
