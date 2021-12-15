<?php
Route::group(['namespace' => 'Retirement', 'middleware' => ['web', 'auth'], 'prefix' => 'retirement', 'as' => 'retirement.'], function () {
    Route::get('', 'RetirementController@index')->name('index');



});
