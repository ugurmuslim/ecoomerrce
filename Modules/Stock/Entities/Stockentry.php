<?php

namespace Modules\Stock\Entities;

use Illuminate\Database\Eloquent\Model;

class Stockentry extends Model
{
  protected $fillable = [];

  protected $table = 'stock_entry';


  public function products2() {

    return $this->belongsToMany('Modules\Product\Entities\Product','stock_entry','size_id','product_id')->withPivot('entry_price')
    ->withPivot('quantity')
    ->withPivot('created_at')
    ->withPivot('production_price');

  }

  public function product() {
    return  $this->belongsTo('Modules\Product\Entities\Product');
  }

  public function stockmovement() {
    return  $this->belongsTo('Modules\Stock\Entities\Stockmovementtype','stock_movement_type_id');
  }

  public function size() {
    return  $this->belongsTo('Modules\Attribute\Entities\Attribute','size_id');
  }

  public function color() {
    return  $this->belongsTo('Modules\Attribute\Entities\Attribute','color_id');
  }

  public function createStockPackageNumber($last_package){
    if($last_package)
    {
      $package_number = $last_package->package + 1;
    }
    else {
      $package_number = 1;
    }
    return $package_number;
  }

  public function instantEntry($attributes,$stock_movement_type_id,$entry_price,$stock_movement_package,$category_id) {
    $i = 0;
    $attribute_entry= [];
    foreach($attributes as $size_id=>$attr) {
      foreach($attr as $color_id=>$quan){
        $attribute_stock[$i] = [$size_id =>['stock_movement_type_id' => $stock_movement_type_id,
        'category_id' => $category_id,
        'color_id' => $color_id,
        'entry_price'=> $entry_price,
        'quantity'=> $quan,
        'price'=> $quan * $entry_price,
        'vendor_id'=> null,
        'package' => $stock_movement_package]];
        $i = $i + 1;
      }
    }
    return $attribute_stock;
  }

  }
