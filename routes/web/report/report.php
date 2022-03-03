<?php
Route::group(['namespace' => 'Reports', 'middleware' => ['web', 'auth'], 'prefix' => 'timesheet_reports', 'as' => 'timesheet_report.'], function () {
    Route::get('index', 'TimesheetReportController@index')->name('index');
    Route::get('submitted', 'TimesheetReportController@getSubmittedTimesheets')->name('submitted');
    Route::get('approved', 'TimesheetReportController@getApprovedTimesheets')->name('approved');
    Route::get('rejected', 'TimesheetReportController@getRejectedTimesheets')->name('rejected');
});
