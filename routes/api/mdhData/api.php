<?php

use Illuminate\Support\Facades\Route;

Route::group(['namespace' => 'MDHData', 'middleware' => ['web', 'auth'], 'prefix' => 'mdh_data', 'as' => 'mdh_data.'], function () {
//    Route::post('ward/store', 'WardController@store')->name('ward');
    Route::get('{country_organisation}/country', 'CountryOrganisationController@getCountry')->name('country_organisation');
    Route::get('{country}/regions', 'CountryController@show')->name('regions');
    Route::get('{region}/districts', 'RegionController@show')->name('districts');
    Route::get('{district}/wards', 'DistrictController@show')->name('wards');

    Route::get('facility/create', 'FacilityController@create')->name('facility-create');
    Route::get('{ownership_category}/ownerships', 'OwnershipCategoryController@show')->name('ownerships');

    Route::get('g_officers', 'GOfficerController@index')->name('g_officers');
    Route::get('g_officer/create', 'GOfficerController@create')->name('g_officer-create');

});
