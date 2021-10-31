<?php
Route::group(['namespace' => 'System', 'middleware' => ['web', 'auth'], 'prefix' => 'regions', 'as' => 'region.'], function () {
    Route::get('by-activity', 'RegionController@byActivity')->name('by_activity');
});
