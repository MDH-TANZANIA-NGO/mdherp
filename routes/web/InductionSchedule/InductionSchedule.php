<?php

use Illuminate\Support\Facades\Route;

Route::group(['namespace' => 'InductionSchedule', 'middleware' => ['web', 'auth'], 'prefix' => 'induction_schedules', 'as' => 'induction_schedule.'], function () {
    Route::get('', 'InductionScheduleController@index')->name('index');
    Route::get('/initiate', 'InductionScheduleController@initiate')->name('initiate');
    Route::post('/storeSchedule', 'InductionScheduleController@storeSchedule')->name('storeSchedule');
    Route::get('{inductionSchedule}/create', 'InductionScheduleController@create')->name('create');
    Route::get('{inductionSchedule}/addParticipants', 'InductionScheduleController@addParticipants')->name('addParticipants');
    Route::post('/participants', 'InductionScheduleController@participants')->name('participants');
    Route::post('store', 'InductionScheduleController@store')->name('store');
    Route::put('{inductionScheduleItem}/update', 'InductionScheduleController@update')->name('update');
    Route::get('{inductionScheduleItem}/show', 'InductionScheduleController@show')->name('show');
    Route::get('{inductionSchedule}/showSchedule', 'InductionScheduleController@showSchedule')->name('showSchedule');
    Route::put('{inductionSchedule}/updateSchedule', 'InductionScheduleController@updateSchedule')->name('updateSchedule');
    Route::put('{inductionSchedule}/markAsComplete', 'InductionScheduleController@markAsComplete')->name('markAsComplete');


    /**
     * Datatables
     */
    Route::group(['prefix' => 'datatable', 'as' => 'datatable.'], function () {
            Route::get('processing', 'InductionScheduleController@processingDatatable')->name('processing');
            Route::get('onGoing', 'InductionScheduleController@onGoing')->name('on-going');
            Route::get('completed', 'InductionScheduleController@completed')->name('completed');
            Route::get('saved', 'InductionScheduleController@saved')->name('saved');
    });

});

