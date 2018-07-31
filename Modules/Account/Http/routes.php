<?php

Route::group(['middleware' => 'web', 'prefix' => 'account', 'namespace' => 'Modules\Account\Http\Controllers'], function()
{
  Route::get('/', 'AccountController@index');
  Route::get('/create', 'AccountController@create')->name('account.create');
  Route::get('/edit', 'AccountController@edit')->name('account.edit');
  Route::post('/', 'AccountController@store')->name('account.store');
  Route::get('/detail', 'AccountController@detail')->name('account.details');
});


Route::group(['middleware' => 'web', 'prefix' => 'api', 'namespace' => 'Modules\Account\Http\Controllers'], function()
{
  Route::get('/adresses/{adress_id}', 'AccountController@getAdresses')->name('account.adresses');
});
