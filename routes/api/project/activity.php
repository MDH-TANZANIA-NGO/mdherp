<?php
Route::group(['namespace' => 'Project', 'middleware' => ['web', 'auth'], 'prefix' => 'activities', 'as' => 'activity.'], function () {
    Route::get('filter-details', 'ActivityController@getActivitiesDetailsOnProjectInitiations')->name('filter');
});
