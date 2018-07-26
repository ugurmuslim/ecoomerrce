<?php

Route::group(['middleware' => 'web', 'prefix' => 'unit', 'namespace' => 'Modules\Unit\Http\Controllers'], function()
{
    Route::get('/', 'UnitController@index');
});
