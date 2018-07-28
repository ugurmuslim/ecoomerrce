<?php

Route::group(['middleware' => ['web','admin'], 'prefix' => 'products', 'namespace' => 'Modules\Product\Http\Controllers\Backend'], function()
{

  Route::get('/change/ready', 'ProductController@changeReady')->name('products.change_ready');
  Route::get('/create', 'ProductController@create')->name('products.create');
  Route::get('/edit/{slug}', 'ProductController@edit')->name('products.edit');
  Route::delete('/{slug}', 'ProductController@destroy')->name('products.destroy');
  Route::get('/', 'ProductController@index')->name('products.index');
  Route::get('/{id}', 'ProductController@show')->name('products.show');
  Route::post('/{id}/resurrect', 'ProductController@resurrect')->name('products.resurrect');
  Route::post('/', 'ProductController@store')->name('products.store');
  Route::post('/change/edit', 'ProductController@editGet')->name('products.edit_get');
  Route::get('/{id}/{size}/{price}/barcode', 'ProductController@barcode')->name('products.barcode');
  Route::get('/productSaleGet/{product_id}/{date_first}/{date_last}','ProductController@productSaleGet')->name('products.productSaleGet');
});



Route::group(['middleware' => ['web',], 'prefix' => 'products', 'namespace' => 'Modules\Product\Http\Controllers\Frontend'], function()
{


  Route::get('/detail/{slug}', 'ProductController@show')->name('product.shop-detail');

});


Route::group(['middleware' => ['web',], 'prefix' => 'api', 'namespace' => 'Modules\Product\Http\Controllers\Frontend'], function()
{


  Route::get('/attributes/{slug}/{attr_id}/{attr}', 'ProductController@attributes');

});
