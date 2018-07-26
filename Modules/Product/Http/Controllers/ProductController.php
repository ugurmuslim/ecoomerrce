<?php

namespace Modules\Product\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Product\Entities\Product;
use Modules\Category\Entities\Category;
use Modules\Unit\Entities\Unit;
use Modules\Attribute\Entities\Attribute;
use Modules\Attribute\Entities\Attributename;
use Image;
class ProductController extends Controller
{


  /**
  * Display a listing of the resource.
  * @return Response
  */
  public function index()
  {
    $products = Product::orderBy('product_id','ASC')->paginate(10);
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
  return view('product::show')->withProduct($product);
}

/**
* Show the form for editing the specified resource.
* @return Response
*/

public function changeReady()
{
  return view('product::change_ready');
}
public function edit($id)
{
  $units2 = Unit::allInArray();
  $cats = Category::allInArray();
  $product = Product::find($id);
  return view('product::edit')->withProduct($product)
  ->withCategories($cats)
  ->withUnits($units2);
}

/**
* Update the specified resource in storage.
* @param  Request $request
* @return Response
*/
public function update(Request $request)
{
}

/**
* Remove the specified resource from storage.
* @return Response
*/
public function destroy()
{
}


public function imageUpload(Request $request)
{
  if ($request->hasFile('file')) {
        $image=$request->file('file');
        $filename = time() . '.' . $image->getClientOriginalExtension();
        $location = public_path('images/' . $filename);
        Image::make($image)->resize(100, 100)->save($location);
      }
}

public function fileDestroy(Request $request)
  {
      $filename =  $request->get('filename');
      ImageUpload::where('filename',$filename)->delete();
      $path=public_path().'/images/'.$filename;
      if (file_exists($path)) {
          unlink($path);
      }
      return $filename;
  }
}
