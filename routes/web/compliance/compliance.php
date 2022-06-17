<?php
Route::group(['namespace' => 'Compliance', 'middleware' => ['web', 'auth'], 'prefix' => 'compliance', 'as' => 'compliance.'], function () {
    Route::get('', 'ComplianceController@index')->name('index');
    Route::get('beneficiaries', 'ComplianceController@beneficiaries')->name('beneficiaries');
    Route::get('export_beneficiaries', 'ComplianceController@exportallBeneficiaries')->name('export_beneficiaries');


});
