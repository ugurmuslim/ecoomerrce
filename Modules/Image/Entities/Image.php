<?php

namespace Modules\Image\Entities;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $fillable = [];


public function scopeMainImage($query){

  return $query->where('main',true)->first();
}

public function scopeFeaturedImages($query){

  return $query->where('main',false)->get();
}
}
