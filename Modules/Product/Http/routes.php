<?php

Route::group(['middleware' => ['web','admin'], 'prefix' => 'products', 'namespace' => 'Modules\Product\Http\Controllers\Backend'], function()
{

  Route::get('/search','ProductController@searchResult')->name('products.search');
  Route::get('/change/ready', 'ProductController@changeReady')->name('products.change_ready');
  Route::get('/create', 'ProductController@create')->name('products.create');
  Route::get('/edit/{slug}', 'ProductController@edit')->name('products.edit');
  Route::put('/{id}','ProductController@update')->name('products.update');
  Route::delete('/{slug}', 'ProductController@destroy')->name('products.destroy');
  Route::get('/', 'ProductController@index')->name('products.index');
  Route::get('/{id}', 'ProductController@show')->name('products.show');
  Route::post('/{id}/resurrect', 'ProductController@resurrect')->name('products.resurrect');
  Route::post('/', 'ProductController@store')->name('products.store');
  Route::post('/change/edit', 'ProductController@editGet')->name('products.edit_get');
  Route::get('/{id}/{size}/{price}/barcode', 'ProductController@barcode')->name('products.barcode');
  Route::get('/productSaleGet/{product_id}/{date_first}/{date_last}','ProductController@productSaleGet')->name('products.productSaleGet');
  Route::get('/detail/action','ProductController@action')->name('products.action');
  Route::post('/detail/setaction','ProductController@setaction')->name('products.setAction');
});



Route::group(['middleware' => ['web',], 'prefix' => 'products', 'namespace' => 'Modules\Product\Http\Controllers\Frontend'], function()
{
  Route::get('/detail/{slug}', 'ProductController@show')->name('product.shop-detail');
  Route::get('/products/all', 'ProductController@index')->name('products.products');

});


Route::group(['middleware' => ['web',], 'prefix' => 'api', 'namespace' => 'Modules\Product\Http\Controllers\Frontend'], function()
{
  Route::get('/attributes/{slug}/{attr_id}/{attr}', 'ProductController@attributes');
});
