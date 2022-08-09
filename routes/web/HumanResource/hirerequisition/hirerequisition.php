
<?php
Route::group(['namespace' => 'HumanResource\HireRequisition', 'middleware' => ['web', 'auth'], 'prefix' => 'hirerequisition', 'as' => 'hirerequisition.'], function () {
    Route::get('', 'HireRequisitionController@index')->name('index');
    Route::get('list', 'HireRequisitionController@list')->name('list');
    Route::get('create', 'HireRequisitionController@create')->name('create');
    Route::get('initiate/{uuid}', 'HireRequisitionController@initiate')->name('initiate');
    Route::post('initiate/{uuid}', 'HireRequisitionController@addRequisition')->name('addRequisition');
    Route::post('store', 'HireRequisitionController@store')->name('store');

    Route::group(['prefix' => 'steps', 'as' => 'steps.'], function () {
            Route::GET('general/{hireRequisitionJob}', 'HireRequisitionController@stepGeneral')->name('general');
            Route::GET('personal_requirement/{hireRequisitionJob}', 'HireRequisitionController@stepPersonalRequirement')->name('personal_requirement');
            Route::GET('employement_condition/{hireRequisitionJob}', 'HireRequisitionController@stepEmploymentCondition')->name('employement_condition');
            Route::GET('criteria/{hireRequisitionJob}', 'HireRequisitionController@stepCriteria')->name('criteria');
            Route::GET('criteria/{hireRequisitionJob}', 'HireRequisitionController@stepReview')->name('review');
            Route::GET('add_criteria/{hireRequisitionJob}', 'HireRequisitionController@addCriteria')->name('add_criteria');
    });

    Route::post('submit/{uuid}', 'HireRequisitionController@submit')->name('submit');
    Route::get('{hirerequisition}/show', 'HireRequisitionController@show')->name('show');
    Route::get('hirerequisitionjob/{hireRequisitionJob}/show', 'HireRequisitionController@stepReview')->name('hire_requisition_job_show');
    Route::get('{hireRequisitionJob}/edit', 'HireRequisitionController@edit')->name('edit');
    Route::get('{hireRequisitionJob}/destroy', 'HireRequisitionController@destroy')->name('destroy');
    Route::get('skills/{category}/list', 'HireRequisitionController@getSkills')->name('category_skills');
    Route::get('designation/{designation}', 'HireRequisitionController@getDesignationByDepertment')->name('getDesignationByDepertment');
    Route::put('{hirerequisition}/update', 'HireRequisitionController@update')->name('update');
    Route::get('{designation_id}/criteriaFilter', 'HireRequisitionController@criteriaFilter')->name('criteriaFilter');

    //  * Datatables
    //  *
    Route::group(['prefix' => 'datatable', 'as' => 'datatable.'], function () {
        Route::group(['prefix' => 'access', 'as' => 'access.'], function () {
            Route::get('processing', 'HireRequisitionController@AccessProcessingDatatable')->name('processing');
            Route::get('returned', 'HireRequisitionController@AccessDeniedDatatable')->name('returned');
            Route::get('rejected', 'HireRequisitionController@AccessRejectedDatatable')->name('rejected');
            Route::get('approved', 'HireRequisitionController@AccessProvedDatatable')->name('approved');
            Route::get('saved', 'HireRequisitionController@AccessSavedDatatable')->name('saved');
        });
    });
});

Route::group(['namespace' => 'humanResource', 'middleware' => 'web'], function(){
    Route::get('vacancies', 'HireRequisitionController@getVacancies')->name('vacancies');
    Route::get('{hirerequisition}/vacancy', 'HireRequisitionController@getVacancy')->name('vacancy');
});
