@extends('admin.layouts.admin')
@section('title', __('views.admin.users.product.show'))
@section('content')

  <div class="row">
    <div class="col-md-8 col-md-offset-2">
      <div class="well text-center">
        <h1><strong>Satış No : {{$sale_package[0]->sale_package}}</strong></h1>
        @if($adress)
        <h3><strong>Müşteri İsmi : {{$adress->first_name . $adress->last_name}}</strong></h3>
        <h3><strong>Email : {{$adress->email}}</strong></h3>
        <h3><strong>Şehir : {{$adress->city}}</strong></h3>
        <p>{{$adress->adress}}</p>
      @endif
        <div class="row">
          <div class="col-md-8 col-md-offset-2">
            @if($sale_package[0]->statu == 1)
              <a href="{{route('sales.delivery',['sale_package'=>$sale_package[0]->sale_package,'statu' => 2])}}" class="btn btn-sm btn-primary">Kargoya Ver</a>
            @else
              <a href="{{route('sales.delivery',['sale_package'=>$sale_package[0]->sale_package,'statu' => 1])}}" class="btn btn-sm btn-danger">Kargoyu Geri Al</a>
            @endif
            @if($sale_package[0]->statu == 3)
              <a href="{{route('sales.delivery',['sale_package'=>$sale_package[0]->sale_package,'statu' => 2])}}" class="btn btn-sm btn-danger">Tammamlamayı Geri Al</a>
            @else
              <a href="{{route('sales.delivery',['sale_package'=>$sale_package[0]->sale_package,'statu' => 3])}}" class="btn btn-sm btn-success">Tammamla</a>
            @endif
          </div>
        </div>
      </div>
      <table class="table">
        <thead>
          <th>Ürün Kodu</th>
          <th>Beden</th>
          <th>Renk</th>
          <th>Miktar</th>
          <th>Birim Fiyat</th>
          <th>Tutar</th>
        </thead>
        <tbody>
          @foreach($sale_package as $sale)
            <tr>
              <td>{{$sale->product_human_id}}</td>
              <td>{{$sale->size->attribute_long}}</td>
              <td>{{$sale->color->attribute_long}}</td>
              <td>{{$sale->sale_quantity}}</td>
              <td>{{$sale->product->price}}</td>
              <td>{{$sale->sale_price}}</td>
              <td></td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
</div>
@endsection
@section('admin_scripts')
@endsection
