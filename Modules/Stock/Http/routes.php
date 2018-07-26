<?php

Route::group(['middleware' => ['web','admin'], 'prefix' => 'stock', 'namespace' => 'Modules\Stock\Http\Controllers'], function()
{
    Route::get('/reportset', 'StockController@reportset')->name('stocks.reportset');
    Route::post('/report','StockController@report')->name('stocks.report');

});


Route::group(['middleware' => 'web', 'prefix' => 'stockentry', 'namespace' => 'Modules\Stock\Http\Controllers'], function()
{
    Route::get('/instant', 'StockentryController@instant')->name('stockentry.instant');
    Route::post('/instant_store', 'StockentryController@instantStore')->name('stockentry.instant_store');
    Route::get('/add/{slug}', 'StockentryController@add')->name('stockentry.add');
    Route::put('/add_entry/{slug}', 'StockentryController@addEntry')->name('stockentry.add_entry');
    Route::get('/edit/{slug}', 'StockentryController@edit')->name('stockentry.edit');
    Route::put('/{slug}', 'StockentryController@update')->name('stockentry.update');

});
