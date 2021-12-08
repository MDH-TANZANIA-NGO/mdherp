<?php
Route::group(['namespace' => 'ProgramActivity', 'middleware' => ['web', 'auth'], 'prefix' => 'programactivity', 'as' => 'programactivity.'], function () {
    Route::get('', 'ProgramActivityController@index')->name('index');


});
