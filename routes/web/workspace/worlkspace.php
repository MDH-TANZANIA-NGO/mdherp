<?php
Route::group(['namespace' => 'Workspace', 'middleware' => ['web', 'auth'], 'prefix' => 'workspace', 'as' => 'workspace.'], function () {
    Route::get('', 'WorkspaceController')->name('invoke');
});
