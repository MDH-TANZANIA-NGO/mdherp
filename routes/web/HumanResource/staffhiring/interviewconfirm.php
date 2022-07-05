<?php

Route::group(['namespace' => 'humanResource\staffhiring', 'middleware' => ['web'], 'prefix' => 'interviewconfirm', 'as' => 'interviewconfirm.'], function () {
    Route::get('{applicant_id}/{interview_id}/interview', 'InterviewConfirmController@index')->name('index');
});
