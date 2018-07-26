<?php

Route::group(['middleware' => 'web', 'prefix' => 'attribute', 'namespace' => 'Modules\Attribute\Http\Controllers'], function()
{
    Route::get('/', 'AttributeController@index');
});
