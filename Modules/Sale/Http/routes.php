<?php

Route::group(['middleware' => ['web','admin'], 'prefix' => 'sale', 'namespace' => 'Modules\Sale\Http\Controllers'], function()
{
    Route::post('/sendMail/{adress}', 'SaleController@deliveryMail')->name('sales.deliveryMail');
    Route::get('/reportset', 'SaleController@reportset')->name('sales.reportset');
    Route::get('/report','SaleController@report')->name('sales.report');
    Route::get('/show/{id}','SaleController@show')->name('sales.show');
    Route::get('/create', 'ProductsaleController@create')->name('sales.create');
    Route::post('/', 'ProductsaleController@store')->name('sales.store');
    Route::get('/return', 'ProductsaleController@return')->name('sales.return');
    Route::get('/update/{sale_package}/{statu}', 'ProductsaleController@deliveryupdate')->name('sales.delivery');

});

Route::group(['middleware' => 'web', 'prefix' => 'api', 'namespace' => 'Modules\Sale\Http\Controllers'], function()
{
  Route::get('/saleTimeGet/{product}/{size}/{color}', 'ProductsaleController@saleTimeGet');

});
