<?php

namespace Modules\Product\Entities;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{

  protected $guarded = [];

  protected $fillable = [];

  public function category() {
    return  $this->belongsTo('Modules\Category\Entities\Category');
  }

  public function unit() {
    return  $this->belongsTo('Modules\Unit\Entities\Unit');
  }

  public function images() {
    return  $this->hasMany('Modules\Image\Entities\Image','type_id')->where('type',1);
  }

  public function sizes() {
    return  $this->belongsToMany('Modules\Attribute\Entities\Attribute','product_attributes','product_id','size_id')->withPivot('stock','color_id');
  }

  public function sizes2() {
    return  $this->belongsToMany('Modules\Attribute\Entities\Attribute','stock_entry','product_id','size_id')->withPivot('entry_price','color_id','quantity','created_at','stock_movement_type_id');
  }
  public function colors() {
    return  $this->belongsToMany('Modules\Attribute\Entities\Attribute','product_attributes','product_id','color_id')->withPivot('stock','size_id');
  }

  public function sales() {
    return  $this->belongsToMany('Modules\Sale\Entities\Sale')->withPivot('sale_price','sale_quantity','size_id')->withTimestamps();
  }

  public function scopeProductSlug($query,$slug){
    return $query->where('slug', $slug);
  }
  public function productNameValidation($slug)
  {
    return $this->ProductSlug($slug)->first();
  }

  public function scopeProductNumber($query,$category){
    return $query->whereBetween(
    'product_id', [$category->number_low, $category->number_high])
    ->orderBy('product_id','Desc');
  }

  public function scopeProductHumanId($query,$product_id){
    return $query->where('product_id', $product_id)->first();
  }



  public function CreateNumber($category) {

    if($product_id_old = $this->ProductNumber($category)->first()) {
      $product_id = $product_id_old->product_id + 1;
    }
    else {
      $product_id = $category->number_low;
    }
    //$product_id = str_pad($product_id, 10, '0', STR_PAD_LEFT);;
    return $product_id;
  }

  public function scopeNameOrId($query, $request)
  {
    return $query->where(function ($subQuery) use ($request) {
      $subQuery->where('name', $request->name_id)
      ->orWhere('product_id',$request->name_id);
    });
    }

}
