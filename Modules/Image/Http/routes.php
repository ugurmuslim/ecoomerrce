<?php

Route::group(['middleware' => ['web','admin'], 'prefix' => 'image', 'namespace' => 'Modules\Image\Http\Controllers'], function()
{
  Route::post('/upload','ImageController@imageUpload')->name('images.imageupload');
  Route::get('/delete/{filename}/{foldername}','ImageController@fileDestroy')->name('images.delete');
  Route::get('/{filename}/{product_id}','ImageController@changeMainPicture')->name('images.main');
  Route::get('/', 'ImageController@index');
});
