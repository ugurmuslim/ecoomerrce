<?php

namespace Modules\Sale\Http\Controllers;

use Illuminate\Http\Request;
use Modules\Sale\Entities\Productsale;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

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
    $sales = Productsale::whereDate('created_at','>=',$time_set[0])
    ->whereDate('created_at','>=',$time_set[1])
    ->get();

    $view = 'sale::report';
    if($request->product_report !== null) {
      $view = 'sale::reportproduct';
    }
    return view($view)->withSales($sales);
  }
}
