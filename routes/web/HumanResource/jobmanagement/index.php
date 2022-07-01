<?php
Route::group(['namespace' => 'JobManagement', 'prefix' => 'job_management', 'as' => 'job_management.'], function () {
    Route::get('', 'JobManagementController@index')->name('index');
});

