<?php
Route::group(['namespace' => 'UserLoginToken', 'middleware' => ['Api', 'auth'], 'prefix' => 'login_token', 'as' => 'login_token.'], function () {
    Route::get('verifyToken', 'UserLoginTokenController@verifyToken')->name('verifyToken');
});
