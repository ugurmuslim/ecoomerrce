<?php

namespace Modules\Image\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Product\Entities\Product;
use Modules\Image\Entities\Image as ImageTable;
use Image;
use Carbon\Carbon;

class ImageController extends Controller
{
  /**
  * Display a listing of the resource.
  * @return Response
  */
  public function imageUpload(Request $request)
  {
    if ($request->hasFile('file')) {
      $image=$request->file('file');
      $filename = str_replace(' ','_',$image->getClientOriginalName());
      ImageTable::insert([
        'type' => $request->type,
        'type_id' => $request->product,
        'name' => $filename,
        'created_at' => Carbon::now(),
        'updated_at' => Carbon::now(),
      ]);
      $folder_name = $request->foldername;
      $location = public_path('images/' . '/' . $folder_name. '/'. $filename);
      Image::make($image)->resize(1200, 1200)->save($location);
    }
  }

  public function fileDestroy($filename,$foldername)
  {
    $filename = str_replace(' ','_',$filename);
    $path=public_path().'/images/' . $foldername . '/' .$filename;
    if (file_exists($path)) {
      unlink($path);
    }
    ImageTable::where('name',$filename)->delete();
    return back();
  }


  public function changeMainPicture($filename,$product_id)
  {
    ImageTable::where('main',true)->where('type_id',$product_id)->update(['main'=>false]);
    ImageTable::where('name',$filename)->where('type_id',$product_id)->update(['main'=>true]);
    return back();
  }



}
