<?php
Route::group(['namespace' => 'General', 'middleware' => ['web', 'auth'], 'prefix' => 'general-settings', 'as' => 'general.'], function () {
    Route::get('', 'GeneralController')->name('invoke');
});
