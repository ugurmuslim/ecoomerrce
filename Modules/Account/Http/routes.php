<?php

Route::group(['middleware' => 'web', 'prefix' => 'account', 'namespace' => 'Modules\Account\Http\Controllers'], function()
{
  Route::get('/', 'AccountController@index');
  Route::get('/create', 'AccountController@create')->name('account.create');
  Route::post('/', 'AccountController@store')->name('account.store');
});
