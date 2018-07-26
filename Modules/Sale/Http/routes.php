<?php

Route::group(['middleware' => ['web','admin'], 'prefix' => 'sale', 'namespace' => 'Modules\Sale\Http\Controllers'], function()
{
    Route::get('/reportset', 'SaleController@reportset')->name('sales.reportset');
    Route::post('/report','SaleController@report')->name('sales.report');
    Route::get('/create', 'ProductsaleController@create')->name('sales.create');
    Route::post('/', 'ProductsaleController@store')->name('sales.store');
    Route::get('/return', 'ProductsaleController@return')->name('sales.return');

});

Route::group(['middleware' => 'web', 'prefix' => 'api', 'namespace' => 'Modules\Sale\Http\Controllers'], function()
{
  Route::get('/saleTimeGet/{product}/{size}/{color}', 'ProductsaleController@saleTimeGet');

});
