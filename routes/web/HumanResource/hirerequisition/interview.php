<?php

Route::group(['namespace' =>'humanResource\Interview', 'middleware' => ['web', 'auth'], 'prefix' => 'interview', 'as' => 'interview.'], function () {

  Route::get('', 'InterviewController@index')->name('index');
  Route::get('create','InterviewController@create')->name('create');
  Route::get('show/{interview}','InterviewController@show')->name('show');
 
  Route::POST('addPanelist','InterviewController@addPanelist')->name('addpanelist');
  Route::GET('initiate/{interview}/panelists','InterviewController@initiatePanelist')->name('initiate-panelist');
  Route::GET('initiate/{interview}/applicants','InterviewController@initiate')->name('initiate');

  Route::POST('notifyapplicant','InterviewController@notifyApplicant')->name('notifyapplicant');
  Route::POST('add','InterviewController@addapplicant')->name('addapplicant');
  Route::GET('applicants/{interview}','InterviewController@applicantlist')->name('applicantlist');
  Route::POST('interveiw/submitForReport','InterviewController@submitForReport')->name('submitForReport');
  Route::GET('panelists/jobs','InterviewController@showPanelistJobs')->name('showPanelistJobs');

  //Interview Report Route
   Route::group(['prefix' => 'report', 'as' => 'report.'], function () {
        Route::get('create/{hireRequisitionJob}','InterviewReportController@create')->name('create');
        Route::POST('store','InterviewReportController@store')->name('store');
        Route::GET('delete/{uuid}','InterviewReportController@destroy')->name('destroy');
        Route::PUT('update','InterviewReportController@update')->name('update'); 
  });

  //Questions Route
  Route::group(['prefix' => 'question', 'as' => 'question.'], function () {
        Route::get('create/{interview}','InterviewQuestionController@create')->name('create');
        Route::POST('store','InterviewQuestionController@store')->name('store');
        Route::GET('delete/{uuid}','InterviewQuestionController@destroy')->name('destroy');
        Route::PUT('update','InterviewQuestionController@update')->name('update');
        Route::POST('marks/store','InterviewQuestionController@storeMarks')->name('storeMarks');
  });

   Route::get('pending', 'InterviewController@pending')->name('pending');
   Route::post('approve', 'InterviewController@approve')->name('approve');
   Route::post('store', 'InterviewController@store')->name('store');
   Route::get('listings', 'InterviewController@listing')->name('listing');

  // Datatables routes
   Route::group(['prefix' => 'datatable', 'as' => 'datatable.'], function () {
    Route::group(['prefix' => 'access', 'as' => 'access.'], function () {
        Route::get('processing', 'InterviewController@accessShortlistedDatatable')->name('shortlisted');
        Route::get('wait_for_interview_questions', 'InterviewController@AccessWaitForQuestionsDatatable')->name('wait_for_interview_question');
    Route::get('wait_for_interview_report', 'InterviewController@AccessWaitForReportDatatable')->name('wait_for_interview_report');

        
    });
    Route::group(['prefix' => 'panelist', 'as' => 'panelist.'], function () {
        Route::get('panelistJobs', 'InterviewController@AccessPanelistJobsDatatable')->name('panelistApplication');
    });
    });
});
