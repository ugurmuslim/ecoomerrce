<?php

namespace Modules\Image\Entities;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $fillable = [];


public function scopeMainImage($query,$type_id){

  return $query->where('main',true)
  ->where('type',$type_id)->first();
}

public function scopeFeaturedImages($query,$type_id){

  return $query->where('main',false)
  ->where('type',$type_id)->get();
}
}
