<?php

Route::group(['namespace' =>'HumanResource\Interview', 'middleware' => ['web', 'auth'], 'prefix' => 'interview', 'as' => 'interview.'], function () {

  Route::get('', 'InterviewController@index')->name('index');
  Route::get('create','InterviewController@create')->name('create');
  Route::POST('add','InterviewController@addapplicant')->name('addapplicant');
  Route::get('initiate/{interview}','InterviewController@initiate')->name('initiate');

   Route::get('pending', 'InterviewController@pending')->name('pending');
   Route::post('approve', 'InterviewController@approve')->name('approve');
   Route::post('store', 'InterviewController@store')->name('store');
   Route::get('show/{Interview}', 'InterviewController@show')->name('show');
   Route::get('listings', 'InterviewController@listing')->name('listing');

 
   Route::group(['prefix' => 'datatable', 'as' => 'datatable.'], function () {
    Route::group(['prefix' => 'access', 'as' => 'access.'], function () {
        Route::get('processing', 'InterviewController@AccessShortlistedDatatable')->name('shortlisted');
    });
    });
});
