<?php

Route::group(['namespace' =>'HumanResource\staffhiring', 'middleware' => ['web'], 'prefix' => 'refferenceform', 'as' => 'refferenceform.'], function () {

  Route::get('', 'RefferenceController@index')->name('index');
  Route::post('store', 'RefferenceController@store')->name('store');
  Route::get('end', 'RefferenceController@end')->name('end');

});




