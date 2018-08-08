<?php

namespace Modules\Sale\Entities;

use DB;
use Auth;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Modules\Sale\Entities\Payment;
use Modules\Product\Entities\Product;

class Productsale extends Model
{
  protected $fillable = [];
  protected $table = 'product_sale';


  public function product() {
    return  $this->belongsTo('Modules\Product\Entities\Product');
  }

  public function sale() {
    return  $this->belongsTo('Modules\Sale\Entities\Sale');
  }

  public function size() {
    return  $this->belongsTo('Modules\Attribute\Entities\Attribute','size_id');
  }

  public function onlineOrders() {
    return  $this->hasMany('Modules\Cart\Entities\Onlineorder','sale_package_id','sale_package');
  }

  public function saleStatu() {
    return  $this->belongsTo('Modules\Sale\Entities\Salestatu','statu');
  }

  public function color() {
    return  $this->belongsTo('Modules\Attribute\Entities\Attribute','color_id');
  }

  public function payment() {
    return  $this->belongsTo('Modules\Sale\Entities\Payment');
  }

  public function scopeLastSale($query) {
    return $query->where('shop_id',Auth::user()->shop_id)
    ->orderBy('created_at','desc')
    ->get()
    ->groupBy('sale_package')->first();
  }
  public function createSalePackageNumber($last_package){
    if($last_package)
    {
      $package_number = $last_package->sale_package + 1;
    }
    else {
      $package_number = 1;
    }
    return $package_number;
  }

  public function store($request) {
    $last_package = $this-> orderBy('id','DESC')->first();
    $sale_package = $this->createSalePackageNumber($last_package);

    if(request('created_date') == Carbon::today()->toDateString()) {
      $time_set = Carbon::now();
    }
    else {
      $time_set = Carbon::tomorrow();
    }
    $sale_id = $request->sale_id;
    $product_quantity = $request->quantity;
    $product_price = $request->product_price;
    $category_id = $request->category_id;
    $product_size = $request->product_size;
    $product_color = $request->product_color;
    $product_id = $request->product_id;
    $product_human_id = $request->product_human_id;
    $product_name = $request->product_name;
    $payment = new Payment;
    $product = new Product;

    //  $non_products = array(1,2,3,4);
    foreach($product_id as $key=>$id){
      $product = $product->find($id);
      $size_id = $product_size[$key];
      $color_id = $product_color[$key];
      $product_quan =  $product_quantity[$key];
      if($sale_id == 2) {
        $product_quan = $product_quan * (-1);
      }
      $product_sale_array[$key] = [
      'product_id' => $id,
      'product_human_id'=>$product_human_id[$key],
      'product_name' => $product_name[$key],
      'category_id' => $product->category_id,
      'sale_id' => $sale_id,
      'size_id' => $size_id ,
      'color_id' => $color_id ,
      'sale_quantity' => $product_quan,
      'sale_price' => $product_price[$key] * $product_quan,
      'campaign_id' => null,
      'payment_id' => 1,
      'statu' => 1,
      'created_at' => $time_set,
      'seller_id' => 1 ,
      'customer_id' => $request->customer_id,
      'middleman_id' => $request->middleman_id,
      'sale_package' => $sale_package,
      ];
      $product->sizes()->where('size_id', $size_id)
      ->where('color_id',$color_id)
      ->decrement('stock',$product_quan);
    }
    Productsale::insert($product_sale_array);

  }

  public function setReportTime($request){
    $time_start = $request->datefirst;
    $payments_array = array();
    $time = $request->options;
    $date = new Carbon();
    $time_set = null;
    if(!$time_start){
      $time_set = Carbon::today()->toDateString();
      if($time == 'D') {
        $time_start = Carbon::today()->toDateString();
      }
      if($time == 'W') {
        $time_start = $date->subWeek();
      }
      if($time == 'M') {
        $time_start = $date->subMonth();
      }
    }
    else {
      $tine_set = $request->datelast;
    }
    return array($time_start,$time_set);
  }
}
