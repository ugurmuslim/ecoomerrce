<?php

namespace Modules\Category\Entities;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
  protected $fillable = [];
  protected $guarded = [];

  public static function allInArray(){
      $categories = Category::all();
      $cats = array();
      foreach ($categories as $category) {
        $cats[$category->id] = $category->name;
      }
      return $cats;
    }


    public function image() {
      return  $this->hasOne('Modules\Image\Entities\Image','type_id')->where('type',2);
    }

    public function products() {
      return  $this->hasMany('Modules\Product\Entities\Product');
    }
}
