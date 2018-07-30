<?php

namespace Modules\Attribute\Entities;

use Illuminate\Database\Eloquent\Model;

class Attribute extends Model
{
  protected $fillable = [];


  public function attributename() {
    return  $this->belongsTo('Modules\Attribute\Entities\Attributename','attribute_id');
  }

  public function instantStock($attributes) {
    $i = 0;
    $attribute_stock = [];
    foreach($attributes as $size_id=>$attr) {
      foreach($attr as $color_id=>$quan){
        $attribute_stock[$i] = ['size_id' =>$size_id , 'color_id' => $color_id, 'stock'=>$quan];
        $i = $i + 1;
      }
    }
    return $attribute_stock;
  }

    public function setNextHumanId(){
      $last_id = $this->orderBy('attribute_human_id','desc')->first()->attribute_human_id;
      return ($last_id + 1);
    }
}
