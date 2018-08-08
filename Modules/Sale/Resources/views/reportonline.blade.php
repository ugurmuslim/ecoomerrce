@extends('admin.layouts.admin')
@section('title', __('views.admin.product.create.title'))
@section('content')
  @php
  $packages = $sales->groupBy('sale_package');
@endphp
<div class="row">
    <div class="col-md-8 col-md-offset-2">
      <button type="button" name="button" class="btn btn-primary btn-block sale-details-button">Satış Detayları</button>
    </div>
  </div>
  <div class="well text-center slide-panels">
    <div class="row">
      <div class="col-md-6">
        @foreach($sales->groupBy('category_id') as $category)
          <p><button type="button" name="button" class="btn btn-default" ><h4>{{number_format($category->sum('sale_quantity'))}} Adet {{ Modules\Category\Entities\Category::find($category[0]->category_id)->name }} Toplam Kazanç : {{number_format($category->sum('sale_price'))}} TL</h4></button></p>
        @endforeach
      </div>

      </div>
      <div class="row">
        <div class="col-md-8 col-md-offset-2">
          <p><h1>Genel Toplam : {{ number_format($sales->sum('sale_price')) }} TL</h1></p>
        </div>
      </div>

    </div>
<div class="row form-spacing-top">
  <div class="col-md-12">
  @foreach($packages as $package_id=>$details)
    <dl class="row" style="background-color:#000030; color:white; ">
      <dd class="col-md-1"><h5><strong>Satış No : {{ $details[0]->sale_package }}</strong></h5></dd>
      <dd class="col-md-2"><h5><strong>Tip : {{ $details[0]->sale->name }}</strong></h5></dd>
      <dd class="col-md-2"><h5><strong>Toplam : {{ number_format($details->sum('sale_price'),2) }}</h5></strong></dd>
      <dd class="col-md-2"><h5><strong>Ödeme Şekli : {{ $details[0]->payment->name }}</h5></strong></dd>
      <dd class="col-md-2"><h5><strong>Tarih :{{ Carbon\Carbon::parse($details[0]->created_at)->format('d/m/Y  H:i')}}</strong></h5></dd>
      <dd class="col-md-2"><h5><strong>Durum : {{($details[0]->saleStatu->name)}}</strong></h5></dd>
    </dl>
    <table class="table" id="table">
      <thead>
        <tr>
          <th>Kod</th>
          <th>İsim</th>
          <th class="phone_not_display">Beden</th>
          <th class="phone_not_display">Renk</th>
          <th class="phone_not_display">Kategori</th>
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
              <th class="phone_not_display">{{ $detail->size->attribute_long }}</th>
              <th class="phone_not_display">{{ $detail->color->attribute_long }}</th>
              <th class="phone_not_display">{{ $detail->product->category->name }}</th>
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
  {{ $sales->links() }}

</div>
</div>
@endsection
@section('admin_scripts')
  @include('partials._slide_panel_javascript')
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
