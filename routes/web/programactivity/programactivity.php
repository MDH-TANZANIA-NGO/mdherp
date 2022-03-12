<?php
Route::group(['namespace' => 'ProgramActivity', 'middleware' => ['web', 'auth'], 'prefix' => 'programactivity', 'as' => 'programactivity.'], function () {
    Route::get('', 'ProgramActivityController@index')->name('index');
    Route::get('workspace', 'ProgramActivityController@workspace')->name('workspace');
    Route::get('initiate', 'ProgramActivityController@initiate')->name('initiate');
    Route::post('store', 'ProgramActivityController@store')->name('store');
    Route::get('{programActivity}/create', 'ProgramActivityController@create')->name('create');
    Route::get('{uuid}/export', 'ProgramActivityController@exportParticipants')->name('export');
    Route::post('{uuid}/update', 'ProgramActivityController@update')->name('update');

    Route::get('{programActivity}/show', 'ProgramActivityController@show')->name('show');
    Route::get('{programActivity}/report', 'ProgramActivityController@programActivityReport')->name('report');
    Route::get('reports', 'ProgramActivityController@reports')->name('reports');
    Route::get('{uuid}/editParticipant', 'ProgramActivityController@editParticipant')->name('editParticipant');
    Route::post('{uuid}/updateParticipant', 'ProgramActivityController@updateParticipant')->name('updateParticipant');
    Route::post('{uuid}/updateProgramActivity', 'ProgramActivityController@updateProgramActivity')->name('updateProgramActivity');
    Route::post('{uuid}/programActivityAttendance', 'ProgramActivityController@programActivityAttendance')->name('programActivityAttendance');
    Route::get('{uuid}/undoEverything', 'ProgramActivityController@undoEverything')->name('undoEverything');
    Route::get('{uuid}/pay', 'ProgramActivityController@pay')->name('pay');
    Route::post('{id}/viewParticipantAttendance', 'ProgramActivityController@viewParticipantAttendance')->name('viewParticipantAttendance');
    Route::post('{uuid}/submitPayment', 'ProgramActivityController@submitPayment')->name('submitPayment');
    Route::post('{uuid}/submit', 'ProgramActivityController@submit')->name('submit');
    Route::post('{uuid}/approveReport', 'ProgramActivityController@approveReport')->name('approveReport');




    /**
     * Datatables
     */
    Route::group(['prefix' => 'datatables', 'as' => 'datatable.'], function () {
        Route::group(['prefix' => 'access', 'as' => 'access.'], function () {
            Route::get('processing', 'ProgramActivityController@AccessProcessingDatatable')->name('processing');
            Route::get('rejected', 'ProgramActivityController@AccessRejectedDatatable')->name('rejected');
            Route::get('approved', 'ProgramActivityController@AccessApprovedDatatable')->name('approved');
            Route::get('saved', 'ProgramActivityController@AccessDatatable')->name('saved');
            Route::get('paid', 'ProgramActivityController@AccesssDatatable')->name('paid');
        });
        Route::group(['prefix' => 'reports', 'as' => 'reports.'], function () {
            Route::get('new', 'ProgramActivityController@ReportNewDatatable')->name('new');
            Route::get('rejected', 'ProgramActivityController@ReportRejectedDatatable')->name('rejected');
            Route::get('approved', 'ProgramActivityController@ReportApprovedDatatable')->name('approved');
        });
    });


});

Route::group(['namespace' => 'Requisition', 'middleware' => ['web', 'auth'], 'prefix' => 'requisitions', 'as' => 'requisition.'], function () {

    Route::get('{requisition}/show', 'RequisitionController@show')->name('show');

});
