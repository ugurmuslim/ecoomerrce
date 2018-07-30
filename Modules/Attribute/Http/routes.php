<?php

Route::group(['middleware' => 'web', 'prefix' => 'attribute', 'namespace' => 'Modules\Attribute\Http\Controllers'], function()
{
    Route::get('/', 'AttributeController@index')->name('attributes.index');
    Route::get('/create', 'AttributeController@create')->name('attributes.create');
    Route::post('/', 'AttributeController@store')->name('attributes.store');
});
