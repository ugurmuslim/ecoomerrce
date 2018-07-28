<?php

Route::group(['middleware' => 'web', 'prefix' => 'cart', 'namespace' => 'Modules\Cart\Http\Controllers'], function()
{
  Route::get('/', 'CartController@index');
  Route::post('/', 'CartController@store')->name('cart.store');
  Route::get('empty','CartController@empty')->name('cart.destroy');
  Route::get('/checkout','CheckoutController@index')->name('checkout.index');
  Route::post('payment/create','CheckoutController@create')->name('payment.create');
  Route::post('payment/callback','CheckoutController@CheckoutRequest')->name('payment.callback');
  Route::get('result','CheckoutController@result')->name('payment.result');
});
