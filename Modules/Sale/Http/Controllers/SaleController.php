<?php

namespace Modules\Sale\Http\Controllers;

use Illuminate\Http\Request;
use Modules\Stock\Entities\Stockentry;
use Modules\Account\Entities\Accountinfo;
use Modules\Sale\Entities\Productsale;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Sale\Emails\OrderShipped;
use Mail;

class SaleController extends Controller
{
  /**
  * Display a listing of the resource.
  * @return Response
  */


  public function reportSet() {
    return view('sale::reportset');
  }

  public function report(Request $request) {
    $sale = new Productsale;
    $date_first = $request->datefirst;
    $date_last = $request->datelast;
    $time_set = $sale->setReportTime($request);
    $sales = Productsale::whereDate('created_at','>=',"$time_set[0]")
    ->whereDate('created_at','<=',"$time_set[1]")
    ->when($request->online_report, function($query) use ($request){
      return $query->where('sale_id',$request->online_report);
    })
    ->when($request->unfinished_online, function($query) use ($request){
      return $query->where('statu','!=',3);
    })
    ->orderBy('id','desc')
    ->paginate(20);

    $view = 'sale::report';

    if($request->product_report !== null) {
      $view = 'sale::reportproduct';
    }

    if($request->online_report !== null) {
      $view = 'sale::reportonline';
    }

    return view($view)->withSales($sales);
  }

  public function show($package_id) {
    $sale_package =  Productsale::where('sale_package',$package_id)->get();
    $adress = null;
    if(count($sale_package[0]->onlineOrders()->get())>0) {
      $adress = Accountinfo::find($sale_package[0]->onlineOrders()->first()->adress_id);
    }
    return view('sale::show')->with('sale_package',$sale_package)
    ->with('adress',$adress);
  }

  public function deliveryMail(Request $request, $adress) {
    $adress =  AccountInfo::find($adress);
    Mail::to($adress->user)->send(new OrderShipped($request->shipping_number,$adress));
    return back()->with('success','Mail Gönderildi');
  }
}
