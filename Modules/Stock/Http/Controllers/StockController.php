<?php

namespace Modules\Stock\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Stock\Entities\Stockentry;
use Modules\Sale\Entities\Productsale;
use Modules\Category\Entities\Category;
use Modules\Unit\Entities\Unit;
use Modules\Attribute\Entities\Attribute;

class StockController extends Controller
{
  /**
  * Display a listing of the resource.
  * @return Response
  */

  public function reportSet() {
    return view('stock::reportset');
  }

  public function report(Request $request) {

    $time = new Productsale;
    $date_first = $request->datefirst;
    $date_last = $request->datelast;
    $time_set = $time->setReportTime($request);
    $stock_entries = Stockentry::whereDate('created_at','>=',$time_set[0])
    ->whereDate('created_at','<=',$time_set[1])
    ->get();
    return view('stock::report')->withStockentries($stock_entries);
  }
}
