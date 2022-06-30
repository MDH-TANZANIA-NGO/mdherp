<?php

Route::group(['namespace' =>'HumanResource\staffhiring', 'middleware' => ['web', 'auth'], 'prefix' => 'refferenceform', 'as' => 'refferenceform.'], function () {

  Route::get('', 'RefferenceController@index')->name('index');
  Route::post('store', 'RefferenceController@store')->name('store');

});



