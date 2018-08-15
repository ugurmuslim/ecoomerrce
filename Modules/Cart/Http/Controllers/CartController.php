<?php

namespace Modules\Cart\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Cart;
class CartController extends Controller
{
  /**
  * Display a listing of the resource.
  * @return Response
  */
  public function index()
  {
    return view('cart::index');
  }

  /**
  * Show the form for creating a new resource.
  * @return Response
  */
  public function create()
  {
    return view('cart::create');
  }

  /**
  * Store a newly created resource in storage.
  * @param  Request $request
  * @return Response
  */
  public function store(Request $request)
  {
    $size = explode('-',$request->size);
    $size_id = $size[0];
    $size_name = $size[1];

    $color = explode('-',$request->color);
    $color_id = $color[0];
    $color_name = $color[1];

    Cart::add($request->product_id,$request->product_name,$request->quantity,$request->product_price,
    ['size'=>['size_id'=>$size_id,'size_name'=>$size_name],
    'color'=>['color_id'=>$color_id,'color_name'=>$color_name]])
    ->associate('App\Product');
    $request->session()
    ->flash('success','Sepete Eklendi');
    return back();
  }

  /**
  * Show the specified resource.
  * @return Response
  */
  public function show()
  {
    return view('cart::show');
  }

  /**
  * Show the form for editing the specified resource.
  * @return Response
  */
  public function edit()
  {
    return view('cart::edit');
  }

  /**
  * Update the specified resource in storage.
  * @param  Request $request
  * @return Response
  */
  public function update(Request $request)
  {
    Cart::update($request->row_id,$request->row_qty);
    return response()->json(['success',true]);
  }

  public function remove($row_id)
  {
    Cart::remove($row_id);
    return response()->json(['success',true]);

  }

  /**
  * Remove the specified resource from storage.
  * @return Response
  */
  public function destroy()
  {
  }

  public function empty()
  {
    Cart::destroy();
  }

  public function getCartContent()
  {
    return response()->json([
    'content' => Cart::content(),
    'total' => Cart::total(),
    'tax' => Cart::tax(),
    'subtotal' => Cart::subtotal(),
    'count' => Cart::content()->count()
    ]);
  }
}
