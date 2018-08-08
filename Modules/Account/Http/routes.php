<?php

Route::group(['middleware' => 'web', 'prefix' => 'account', 'namespace' => 'Modules\Account\Http\Controllers'], function()
{
  Route::get('/', 'AccountController@index');
  Route::get('/create', 'AccountController@create')->name('account.create');
  Route::get('/edit', 'AccountController@edit')->name('account.edit');
  Route::post('/', 'AccountController@store')->name('account.store');
  Route::get('/detail', 'AccountController@detail')->name('account.details');
  Route::post('/update', 'AccountController@update')->name('account.update');
  Route::get('/password', 'AccountController@passwordEdit')->name('account.password');
  Route::post('/password-update', 'AccountController@passwordUpdate')->name('account.password_update');
});


Route::group(['middleware' => 'web', 'prefix' => 'api', 'namespace' => 'Modules\Account\Http\Controllers'], function()
{
  Route::get('/adresses/{adress_id}', 'AccountController@getAdresses')->name('account.adresses');
});
