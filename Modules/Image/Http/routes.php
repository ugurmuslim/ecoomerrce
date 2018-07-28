<?php

Route::group(['middleware' => ['web','admin'], 'prefix' => 'image', 'namespace' => 'Modules\Image\Http\Controllers'], function()
{
  Route::post('/upload','ImageController@imageUpload')->name('images.imageupload');
  Route::get('/delete/{filename}','ImageController@fileDestroy')->name('images.delete');
  Route::get('/', 'ImageController@index');
});
