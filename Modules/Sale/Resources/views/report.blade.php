@extends('admin.layouts.admin')
@section('title', __('views.admin.product.create.title'))
@section('content')
  @php
  $packages = $sales->groupBy('sale_package');
@endphp

<div class="row form-spacing-top">
  <div class="col-md-12">

  @foreach($packages as $package_id=>$details)
    <dl class="row" style="background-color:#000030; color:white; ">
      <dd class="col-md-1"><strong>Satış No : {{ $details[0]->sale_package }}</strong></dd>
      <dd class="col-md-2"><strong>Tip : {{ $details[0]->sale->name }}</strong></dd>
      <dd class="col-md-2"><strong>Toplam : {{ number_format($details[0]->sum('sale_price'),2) }}</strong></dd>
      <dd class="col-md-2"><strong>Ödeme Şekli : {{ $details[0]->payment->name }}</strong></dd>
      <dd class="col-md-2"><strong>Tarih :{{ Carbon\Carbon::parse($details[0]->created_at)->format('d/m/Y  H:i')}}</strong></dd>
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
          <th>Satış Fiyat</th>
        </tr>
      </thead>

      <tbody>
        @foreach($details as $detail)
          <tr>

            <tr>
              <th><a href="{{route('products.show',$detail->product->slug)}}">{{ $detail->product_human_id }}</a></th></a></th>
              <th><a href="{{route('products.show',$detail->product->slug)}}">{{ $detail->product_name }} </a></th>
              <th>{{ $detail->size->attribute_long }}</th>
              <th>{{ $detail->color->attribute_long }}</th>
              <th>{{ $detail->product->category->name }}</th>
              <th>{{ $detail->sale_quantity }}</th>
              <th>{{ $detail->product->price }}</th>
              <th>{{ $detail->sale_price }}</th>
              {{--  <th><a href="{{route('customers.show',$detail->customer_id)}}">{{ $detail->customer_name  }} </a></th>--}}
            </tr>
          </tr>
        @endforeach
      </tbody>

    </table>
  @endforeach
</div>
</div>
@endsection
@section('admin_scripts')
  <script type="text/javascript">
    $(function(){
      var $manual = $('.manual');
      $('#formanual').on('click',function(){
        if($manual.attr('disabled')) {
          $('.manual').removeAttr('disabled');
        }
        else {
          console.log('sd');
          $('.manual').attr('disabled','');
        }
      });
    });
  </script>
@endsection
</script>
