<?php

Route::group(['middleware' => ['web','admin'], 'prefix' => 'categories', 'namespace' => 'Modules\Category\Http\Controllers'], function()
{
  Route::put('/update/{id}', 'CategoryController@update')->name('categories.update');
  Route::get('/create', 'CategoryController@create')->name('categories.create');
  Route::post('/', 'CategoryController@store')->name('categories.store');
  Route::get('/index', 'CategoryController@index')->name('categories.index');
  Route::delete('/{id}', 'CategoryController@destroy')->name('categories.destroy');
  Route::get('/{id}', 'CategoryController@show')->name('categories.show');
  Route::get('/edit/{id}', 'CategoryController@edit')->name('categories.edit');
});
