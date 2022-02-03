<?php

Route::group(['namespace' => 'MDHData', 'middleware' => ['web', 'auth'], 'prefix' => 'mdh_data', 'as' => 'mdh_data.'], function () {
    Route::get('{country_organisation}/country', 'CountryOrganisationController@getCountry')->name('country_organisation');
    Route::get('{country}/regions', 'CountryController@show')->name('regions');
    Route::get('{region}/districts', 'RegionController@show')->name('districts');
});
