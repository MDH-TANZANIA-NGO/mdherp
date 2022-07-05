<?php

Route::group(['namespace' => 'humanResource\staffhiring', 'middleware' => ['web'], 'prefix' => 'interviewconfirm', 'as' => 'interviewconfirm.'], function () {
    Route::get('{job_id}/interview', 'InterviewConfirmController@index')->name('index');
});
