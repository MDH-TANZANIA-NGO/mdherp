<?php
Route::group([ 'namespace' => 'Hotspot', 'prefix' => 'hotspot',  'as' => 'hotspot.'], function() {
    Route::post('store', 'HotspotController@store')->name("store");
});
