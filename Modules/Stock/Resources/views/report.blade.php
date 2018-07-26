@extends('admin.layouts.admin')
@section('title', __('views.admin.product.create.title'))
@section('content')
  @php
  $packages = $stockentries->groupBy('package');
@endphp


    <div class="row form-spacing-top">

<div class="col-md-12">

      @foreach($packages as $package_id=>$details)
        <dl class="row" style="background-color:#000030; color:white; ">
          <dd class="col-md-2"><strong>Tip : {{ $details[0]->stockmovement->name }}</strong></dd>
          <dd class="col-md-2"><strong>Toplam : {{number_format($details->sum(function ($x) {
            return  $x->entry_price * $x->quantity;
          }),2)}} TL</strong></dd>
          <dd class="col-md-2"><strong>Tarih :{{ Carbon\Carbon::parse($details[0]->created_at)->format('d/m/Y  H:i')}}</strong></dd>
          <dd class="col-md-6">
            <div class="float-right">
            </div>
            <a href="#" class="btn btn-success btn-sm float-right mr-5">Fatura Çıktısı Al</a></dd>
          </dl>
          <table class="table" id="table">
            <thead>
              <tr>
                <th>Kod</th>
                <th>İsim</th>
                <th>Beden</th>
                <th>Renk</th>
                <th>Kategori</th>
                <th>Miktar</th>
                <th>Birim Fiyat</th>
                <th>Hareket Fiyatı</th>
              </tr>
            </thead>
            <tbody>
              @foreach($details as $detail)
                <tr>
                  <th><a href="{{route('products.show',$detail->product->slug)}}">{{ $detail->product->product_id }}</a></th></a></th>
                  <th><a href="{{route('products.show',$detail->product->slug)}}">{{ $detail->product->name }} </a></th>
                  <th>{{ $detail->size->attribute_long }} </a></th>
                  <th>{{ $detail->color->attribute_long }}</th>
                  <th>{{ $detail->product->category->name }}</th>
                  <th>{{ $a = $detail->quantity }}</th>
                  <th>{{ $b = $detail->entry_price }}</th>
                  <th>{{ $a * $b }}</th>
                </tr>
              @endforeach
            </tbody>
          </table>
          <hr>
        @endforeach
      </div>
</div>
    @endsection
