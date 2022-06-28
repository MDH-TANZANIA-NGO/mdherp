<?php

Route::group(['namespace' =>'HumanResource\Interview', 'middleware' => ['web', 'auth'], 'prefix' => 'interview', 'as' => 'interview.'], function () {

  Route::get('', 'InterviewController@index')->name('index');
  Route::get('create','InterviewController@create')->name('create');
  Route::get('initiate/{initiate}','InterviewController@initiate')->name('initiate');

   Route::get('pending', 'InterviewController@pending')->name('pending');
   Route::post('approve', 'InterviewController@approve')->name('approve');
   Route::post('store', 'InterviewController@store')->name('store');
   Route::get('show/{Interview}', 'InterviewController@show')->name('show');
   Route::get('listings', 'InterviewController@listing')->name('listing');

 
   Route::group(['prefix' => 'datatable', 'as' => 'datatable.'], function () {
    Route::group(['prefix' => 'access', 'as' => 'access.'], function () {
        Route::get('processing', 'InterviewController@AccessProcessingDatatable')->name('processing');
        Route::get('returned', 'InterviewController@AccessDeniedDatatable')->name('returned');
        Route::get('rejected', 'InterviewController@AccessRejectedDatatable')->name('rejected');
        Route::get('approved', 'InterviewController@AccessProvedDatatable')->name('approved');
        Route::get('saved', 'InterviewController@AccessSavedDatatable')->name('saved');
    });
});
});
