<?php
Route::group(['namespace' => 'JobManagement', 'prefix' => 'job_management', 'as' => 'job_management.'], function () {
    Route::get('', 'JobManagementController@index')->name('index');
    Route::get('settings', 'JobManagementController@settings')->name('settings.settings');
    Route::get('skills/create', 'JobManagementController@createSkills')->name('settings.skills');
    Route::post('skills/store', 'JobManagementController@storeSkill')->name('settings.storeSkill');
    
    Route::get('experience/create', 'JobManagementController@createExperience')->name('settings.experience');
    Route::post('experience/store', 'JobManagementController@storeExperience')->name('settings.storeExperience');
    Route::post('designation/store/designationSkill', 'JobManagementController@storeDesignationSkill')->name('settings.storeDesignationSkill');
    Route::post('designation/store/designationExperience', 'JobManagementController@storeDesignationExperience')->name('settings.storeDesignationExperience');
    Route::get('designation/show/{designation}', 'JobManagementController@showDesignation')->name('settings.designation.show');
});

