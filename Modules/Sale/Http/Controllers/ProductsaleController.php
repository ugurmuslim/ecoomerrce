<?php

namespace Modules\Sale\Http\Controllers;


use Carbon\Carbon;
use Session;
use Auth;
use App\Models\Auth\User\User;
use Illuminate\Http\Request;
use Modules\Sale\Entities\Payment;
use Modules\Sale\Entities\Productsale;
use Modules\Product\Entities\Product;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

class ProductsaleController extends Controller
{
  /**
  * Display a listing of the resource.
  * @return Response
  */
  public function index()
  {
    return view('sale::index');
  }

  /**
  * Show the form for creating a new resource.
  * @return Response
  */
  public function create()
  {
    $payments = Payment::all();

    /*  $customer = new Customer;
    $last_sales = $sale->lastSale();
    $payments = $payment->all();
    $customers = $customer->realCustomers()->get();
    $users = $user->usersWithShop()->get();
    */
    return view('sale::create')->withPayments($payments);
  }

  public function saleTimeGet($product_id,$size_id,$color_id) {
    $product = new Product;
    $product = $product->ProductHumanId($product_id);
    $sizes = $product->sizes()->where('attribute_human_id',$size_id)->first();
    $colors = $product->colors()->where('attribute_human_id',$color_id)->first();
    return array($product,$sizes,$colors);
  }


  /**
  * Store a newly created resource in storage.
  * @param  Request $request
  * @return Response
  */
  public function store(Request $request)
  {
    if(!$request->product_id) {
      return redirect()->back()->withError("En Az Bir Kalem Girmeniz Lazım.");
    }
    $product_sale = new Productsale;
    $product_sale->store($request);
    Session::flash('success','Ürünler Başarı ile Satıldı');
    return redirect()->back();
  }


  /**
  * Show the specified resource.
  * @return Response
  */

  public function return() {
    $payments = Payment::all();
    return view('sale::return')->withPayments($payments);

  }

  /**
  * Remove the specified resource from storage.
  * @return Response
  */
  public function destroy()
  {
  }

  public function deliveryUpdate($package_id,$statu)
  {
    Productsale::where('sale_package',$package_id)->update(['statu'=>$statu]);
    return redirect()->route('sales.show',$package_id);
  }




}
