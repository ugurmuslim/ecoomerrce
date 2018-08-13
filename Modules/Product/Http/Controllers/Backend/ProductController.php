<?php

namespace Modules\Product\Http\Controllers\Backend;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Product\Entities\Product;
use Modules\Category\Entities\Category;
use Modules\Unit\Entities\Unit;
use Modules\Stock\Entities\Stockentry;
use Modules\Attribute\Entities\Attribute;
use Modules\Attribute\Entities\Attributename;
use DB;
use Image;
class ProductController extends Controller
{


  /**
  * Display a listing of the resource.
  * @return Response
  */
  public function index()
  {
    $products = Product::where('deleted','!=',1)->orderBy('product_id','ASC')->paginate(10);
    return view('product::index')->withProducts($products);
  }

  /**
  * Show the form for creating a new resource.
  * @return Response
  */
  public function create()
  {
    $categories = Category::orderBy('id','asc')->get();
    $units = Unit::all();
    $attribute_names = Attributename::all();
    return view('product::create')->withCategories($categories)
    ->withUnits($units)
    ->withAttribute($attribute_names);
  }

  /**
  * Store a newly created resource in storage.
  * @param  Request $request
  * @return Response
  */
  public function store(Request $request)
  {
    $category = Category::find($request->category_id);
    $product = new Product;
    $slug = str_slug($request->name, "-");
    if ($product->productNameValidation($slug)) {
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
    $product_id = $product->createNumber($category);
    $stock_attributes = $request->stock_attributes;

    $product = Product::create([
    'product_id' => $product_id,
    'name' => request('name'),
    'slug' => $slug,
    'details' => request('details'),
    'category_id' => request('category_id'),
    'unit_id' => request('unit_id'),
    'price' => request('price'),
    'size_track' => request('size_track'),
    ]);
    $size_track = $request->size_track;
    $stock_movement_type = 1;
    $entry_price = null;
    $stock_movement_package = null;
    $category_id = null;
    $attribute = new Attribute;
    $stock_entry1 = new Stockentry;
    $stocks = $attribute->instantStock($stock_attributes);
    $entries = $stock_entry1->instantEntry($stock_attributes,$stock_movement_type,$entry_price,$stock_movement_package,$category_id);
    foreach($stocks as $stock ) {
      $product->sizes()->attach([$stock['size_id']=>['color_id' =>$stock['color_id'],'stock'=>$stock['stock']]]);
    }
    /*$size = new Size;
    $size_array = $size->forProduct($size_track,$request->category_id);
    $product->sizes()->sync($size_array,false);
    */
    $request->session()
    ->flash('success',"Ürün $product->product_id Numarası ile Başarı ile Yaratıldı");
    return redirect()->route('products.create');
  }
  /**
}

/**
* Show the specified resource.
* @return Response
*/
public function show($slug)
{
  $product = Product::where('slug',$slug)->first();
  $product_latest_quantity = null;
  if($product_latest_entry = DB::table('stock_entry')->where('product_id',$product->id)->orderBy('created_at','desc')->get()->groupBy('created_at')->first()) {
    $product_latest_quantity = $product_latest_entry->sum('quantity');
  }
  return view('product::show')->withProduct($product)
  ->with('product_latest_quantity',$product_latest_quantity);

}

/**
* Show the form for editing the specified resource.
* @return Response
*/

public function action()
{
  return view('product::product-action');
}

public function setAction(Request $request)
{
  $product = new Product;
  if($product = $product->nameOrId($request)->first()) {
    if($request->name == "Değiştir") {
      return redirect()->route('products.edit',$product->slug);
    }
    elseif($request->name == "Görüntüle") {
      return redirect()->route('products.show',$product->slug);
    } elseif($request->name == "Stok Gir") {
      return redirect()->route('stockentry.instant',$product->slug);
    }else {
      return redirect()->route('stockentry.edit',$product->slug);

    }
    $request->session()
    ->flash('error','Böyle bir ürün yoktur');
    return redirect()->back();
  }
  }



  public function edit($slug)
  {
    $units2 = Unit::allInArray();
    $cats = Category::allInArray();
    $product = Product::where('slug',$slug)->first();
    return view('product::edit')->withProduct($product)
    ->withCategories($cats)
    ->withUnits($units2);
  }

  /**
  * Update the specified resource in storage.
  * @param  Request $request
  * @return Response
  */
  public function update(Request $request,$id)
  {
    $request->validate(array(
    'name' => 'required|max:50',
    'category_id' => 'required',
    'unit_id' => 'required',
    'price' => 'required',
    ));
    $product = Product::find($id);
    $product->name = $request->name;
    $product->price = $request->price;
    $product->details = $request->details;
    $product->category_id = $request->category_id;
    $product->unit_id = $request->unit_id;
    $slug = str_slug($request->name, "-");
    $product->slug = $slug;
    $product->save();
    return view('product::product-action')->with('success',"Ürün Başarı ile Güncellendi");

  }

  /**
  * Remove the specified resource from storage.
  * @return Response
  */
  public function destroy($slug)
  {
    $product = Product::where('slug',$slug)->first();
    $product->update(['deleted'=>1]);
    return back();
  }

  public function resurrect($slug)
  {
    $product = Product::where('slug',$slug)->first();
    $product->update(['deleted'=>0]);
    return back();
  }



  public function imageUpload(Request $request)
  {
    if ($request->hasFile('file')) {
      $image=$request->file('file');
      $filename = $image->getClientOriginalName();
      $location = public_path('images/' . $filename);
      Image::make($image)->resize(100, 100)->save($location);
    }
  }



  public function fileDestroy(Request $request)
  {
    $filename =  request('filename');
    $path=public_path().'/images/'.$filename;
    if (file_exists($path)) {
      unlink($path);
    }
    return $filename;
  }

  public function searchResult(Request $request)
  {

    $query = $request->input('search');
    $products = Product::where('name','like',"%$query%")->get();
    return view('shop::search-results')->withProducts($products)
    ->withQuery($query);
  }


}
