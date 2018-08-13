<?php

namespace Modules\Stock\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Product\Entities\Product;
use Modules\Category\Entities\Category;
use Modules\Stock\Entities\Stockentry;
use Modules\Unit\Entities\Unit;
use DB;
use Auth;
use Modules\Attribute\Entities\Attribute;
use Modules\Attribute\Entities\Attributename;

class StockentryController extends Controller
{
  /**
  * Display a listing of the resource.
  * @return Response
  */
  public function index()
  {
    return view('stock::index');
  }

  /**
  * Show the form for add a new resource.
  * @return Response
  */
  public function create()
  {
    return view('stock::create');
  }

  public function instant()
  {
    $categories = Category::orderBy('id','asc')->get();
    $units = Unit::all();
    $attribute_names = Attributename::all();
    $attributes = Attribute::all();
    return view('stock::instant')->withCategories($categories)
    ->withUnits($units)
    ->withAttributenames($attribute_names)
    ->withAttributes($attributes);
  }

  public function instantStore(Request $request)
  {
    $slug = str_slug($request->name, "-");
    $product = new Product;

    if ($product->productNameValidation($request->name)) {
      $error = "Bu isimde bir ürün zaten yaratılmış.";
      return redirect()->back()->withError($error)
      ->withInput();
    }
    $request->validate(array(
    'name' => 'required|max:50',
    'category_id' => 'required',
    'unit_id' => 'required',
    'price' => 'required',
    ));
    $stock_entry = new Stockentry;
    $last_package = Stockentry::orderBy('id','DESC')->first();
    $stock_movement_package = $stock_entry->createStockPackageNumber($last_package);
    $product->name = $request->name;
    $product->category_id = $request->category_id;
    $product->unit_id = $request->unit_id;
    $product->price = $request->price;
    $product->details = $request->details;
    $product->size_track = $request->size_track;
    $product->slug = $slug;
    $stock_attributes = $request->stock_attributes;
    $price_all = $request->price_size;
    $entry_price = $request->entry_price;
    $stock_movement_type = 1;
    $category_id = $request->category_id;
    $stock_entry=array();
    $attribute = new Attribute;
    $stock_entry1 = new Stockentry;
    $stocks = $attribute->instantStock($stock_attributes);
    $entries = $stock_entry1->instantEntry($stock_attributes,$stock_movement_type,$entry_price,$stock_movement_package,$category_id);
    $category = Category::find($request->category_id);
    $product->product_id = $product->createNumber($category);
    $product->save();
    foreach($stocks as $stock ) {
      $product->sizes()->attach([$stock['size_id']=>['color_id' =>$stock['color_id'],'stock'=>$stock['stock']]]);
    }

    foreach($entries as $entry ) {
      $product->sizes2()->attach($entry);
    }

    $request->session()
    ->flash('success',"Ürün $product->product_id Numarası ile Başarı ile Yaratıldı");
    return redirect()->route('products.show',$product->slug);
  }
  /**
  * Store a newly created resource in storage.
  * @param  Request $request
  * @return Response
  */


  public function add(Request $request,$slug)
  {
    $product = new Product;
    $product = $product->productSlug($slug)->first();
    $attribute_names = Attributename::all();
    $attributes = Attribute::all();
    return view('stock::add')->withProduct($product)
    ->withAttributenames($attribute_names)
    ->withAttributes($attributes);
  }

  public function addEntry(Request $request,$slug) {
    $stock_entry = new Stockentry;
    $last_package = Stockentry::orderBy('id','DESC')->first();
    $stock_movement_package = $stock_entry->createStockPackageNumber($last_package);
    $attribute = new Attribute;
    $stock_entry1 = new Stockentry;
    $product = new Product;
    $product = $product->productSlug($slug)->first();
    $category_id = $product->category_id;
    $stock_attributes = $request->stock_attributes;
    $entry_price = $request->entry_price;
    $stock_movement_type = 1;
    $time_set = $request->created_at . " " . $request->created_at_hour;
    $stocks = $attribute->instantStock($stock_attributes);
    $entries = $stock_entry1->instantEntry($stock_attributes,$stock_movement_type,$entry_price,$stock_movement_package,$category_id);

    foreach($stocks as $stock) {
      if($stock['stock']) {
      if($p = $product->sizes()->where('size_id',$stock['size_id'])->where('color_id',$stock['color_id'])->first()){
        $last_stock = $p->pivot->stock + $stock['stock'];
        DB::table('product_attributes')->where('product_id',$product->id)
          ->where('size_id' , $stock['size_id'])
          ->where('color_id' , $stock['color_id'])
          ->increment('stock',$stock['stock']);
        }
      else {
        $product->sizes()->attach([$stock['size_id']=>['color_id' =>$stock['color_id'],'stock'=>$stock['stock']]]);
      }
    }
    }
    if($stock['stock']) {
    foreach($entries as $entry ) {
      $product->sizes2()->attach($entry);
    }
  }

    $request->session()
    ->flash('success',"$product->name Ürünü Stoğa Girildi");
    return redirect()->route('products.show',$product->slug);
  }

  /**
  * Show the specified resource.
  * @return Response
  */
  public function show()
  {
    return view('stock::show');
  }

  /**
  * Show the form for editing the specified resource.
  * @return Response
  */
  public function edit($slug)
  {
    $product = new Product;
    $product = $product->productSlug($slug)->first();
    return view('stock::edit')->withProduct($product);
  }

  /**
  * Update the specified resource in storage.
  * @param  Request $request
  * @return Response
  */
  public function update(Request $request,$slug)
  {
    $product = new Product;
    $product = $product->productSlug($slug)->first();
    $stock_entry = new Stockentry;
    $last_package = Stockentry::orderBy('id','DESC')->first();
    $stock_movement_package = $stock_entry->createStockPackageNumber($last_package);
    $stock_attributes = $request->stock_attributes;
    $stock_movement_type = 4;
    $attribute = new Attribute;
    $stock_entry1 = new Stockentry;
    $time_set = $request->created_at . " " . $request->created_at_hour;
    $stocks = $attribute->instantStock($stock_attributes);
    $entry_price = $product->sizes2()->orderBy('pivot_created_at','desc')->first()->pivot->entry_price;

    foreach($stocks as $stock) {
      $stock_before = $product->sizes()->where('size_id',$stock['size_id'])->where('color_id',$stock['color_id'])->first()->pivot->stock;
      if($stock['stock'] != $stock_before){
        $stock_difference = $stock['stock'] - $stock_before;
         DB::table('product_attributes')->where('product_id',$product->id)
          ->where('size_id' , $stock['size_id'])
          ->where('color_id' , $stock['color_id'])
          ->increment('stock',$stock_difference);
          $product->sizes2()->attach([$stock['size_id']=>['stock_movement_type_id'=>$stock_movement_type,
          'cateory_id'=>$product_category_id,
          'color_id'=>$stock['color_id'],
          'quantity'=> $stock_difference,
          'entry_price'=> $entry_price,
          'vendor_id'=> null,
          'package' =>$stock_movement_package
              ]]);

        }
      }
      $request->session()
      ->flash('success',"$product->name Ürünü Stoğa Girildi");
      return redirect()->route('products.show',$product->slug);
    }

  /**
  * Remove the specified resource from storage.
  * @return Response
  */
  public function destroy()
  {
  }
}
