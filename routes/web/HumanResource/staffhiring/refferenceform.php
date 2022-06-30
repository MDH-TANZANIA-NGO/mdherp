<?php

Route::group(['namespace' =>'HumanResource\staffhiring', 'middleware' => ['web', 'auth'], 'prefix' => 'refferenceform', 'as' => 'refferenceform.'], function () {

  Route::get('', 'AdvertisementController@index')->name('index');


});




