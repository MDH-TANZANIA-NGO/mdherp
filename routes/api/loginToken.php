<?php
Route::group(['namespace' => 'UserLoginToken', 'middleware' => ['web', 'auth'], 'prefix' => 'login_token', 'as' => 'login_token.'], function () {
    Route::get('verifyToken', 'UserLoginTokenController@verifyToken')->name('verifyToken');
});
