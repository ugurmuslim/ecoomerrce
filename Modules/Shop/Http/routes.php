<?php

Route::group(['middleware' => 'web', 'prefix' => 'shop', 'namespace' => 'Modules\Shop\Http\Controllers'], function()
{
    Route::get('/', 'ShopController@index')->name('shop.index');
    Route::get('/product-detail/{slug}', 'ShopController@productShow')->name('shop.product-detail');
    Route::get('/contact', 'ShopController@contact')->name('shop.contact');
    Route::get('/checkout', 'ShopController@checkout')->name('shop.checkout');
});
