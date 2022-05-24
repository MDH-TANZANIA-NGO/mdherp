<?php
Route::group(['namespace' => 'System', 'middleware' => ['web', 'auth'], 'prefix' => 'regions', 'as' => 'region.'], function () {
    Route::get('{activity_id}/activity', 'RegionController@byActivity')->name('by_activity');
});
