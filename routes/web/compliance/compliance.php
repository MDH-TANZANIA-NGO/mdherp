<?php
Route::group(['namespace' => 'Compliance', 'middleware' => ['web', 'auth'], 'prefix' => 'compliance', 'as' => 'compliance.'], function () {
    Route::get('', 'ComplianceController@index')->name('index');


});
