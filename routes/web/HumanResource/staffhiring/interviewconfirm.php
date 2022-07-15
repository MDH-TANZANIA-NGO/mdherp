<?php

Route::group(['namespace' => 'HumanResource\StaffHiring', 'middleware' => ['web'], 'prefix' => 'interviewconfirm', 'as' => 'interviewconfirm.'], function () {
    Route::get('{applicant_id}/{interview_id}/interview', 'InterviewConfirmController@index')->name('index');
    Route::get('{interview_applicant_id}/interviewconf', 'InterviewConfirmController@update')->name('update');
});
