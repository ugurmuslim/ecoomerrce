@extends('admin.layouts.admin')
@section('title', __('views.admin.product.create.title'))
@section('content')
  @php
  $categories = $sales->groupBy('category_id');
  $packages = $sales->groupBy('sale_package');
  $total_entries = 0;
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

  <div class="row form-spacing-top">
    <div class="col-md-8 col-md-offset-2 total_entries">
    </div>
  </div>
</div>
<div class="row form-spacing-top">
  <div class="col-md-12">
    @foreach($categories as $category=>$details)
      <dl class="row" style="background-color:#000030; color:white; ">
        <dd class="col-md-1"><h5><strong>Tip : {{ Modules\Category\Entities\Category::find($category)->name }}</strong></h5></dd>
        <dd class="col-md-2"><h5><strong>Toplam :{{ $details->sum('sale_price')}}</strong></h5></dd>
      </dl>
      <table class="table" id="table">
        <thead>
          <tr>
            <th style="width:10%;">Kod</th>
            <th style="width:10%;">İsim</th>
            <th style="width:10%;">Miktar</th>
            <th style="width:10%;">Birim Satış Fiyatı</th>
            <th class="phone_not_display">Birim Geliş Fiyatı</th>
            <th class="phone_not_display">Miktar x Geliş </th>
            <th class="phone_not_display">Toplam Ciro</th>
            <th style="width:10%;">Ciro  - Toplam Geliş (Kar) </th>
            <th class="phone_not_display">Stok</th>
          </tr>
        </thead>
        <tbody>
          @php
            $products = $details->groupBy('product_id');
          @endphp
          @foreach($products as $product_block)
            @php
              $product = Modules\Product\Entities\Product::find($product_block[0]->product_id);
            @endphp
            <tr>
              <tr>
                <th><a href="{{route('products.show',$product->slug)}}">{{ $product->product_id }}</a></th></a></th>
                <th><a href="{{route('products.show',$product->slug)}}">{{ $product->name}} </a></th>
                <th>{{ $product_block->sum('sale_quantity') }}</th>
                <th class="phone_not_display">{{ $sale_price = $product->price }}</th>
                <th class="phone_not_display">{{ $entry_price = $product->sizes2()->orderBy('pivot_created_at','desc')->first()->pivot->entry_price }}</th>
                <th class="phone_not_display">{{ $total_entry = $product_block->sum('sale_quantity') * $entry_price }}</th>
                <th class="phone_not_display">{{ $total_sale = $product_block->sum('sale_quantity') * $sale_price }}</th>
                <th>{{ $total_sale - $total_entry }}</th>
                <th class="phone_not_display">{{ $product->sizes()->sum('stock') }} {{$product->unit->name}}</th>
                {{--  <th><a href="{{route('customers.show',$detail->customer_id)}}">{{ $detail->customer_name  }} </a></th>--}}
              </tr>
            </tr>
           @php
           $total_entries += $total_entry;
           @endphp
          @endforeach
        </tbody>
      </table>
    @endforeach
    
  </div>
</div>
@endsection
@section('admin_scripts')
  @include('partials._slide_panel_javascript')
  <script type="text/javascript">
  var $entries_total = {{$total_entries}};
  console.log($entries_total);
              $total_entries_div = $('.total_entries');
              $total_entries_div.append("<p><h1>Toplam Ürün Maliyet : " + $entries_total + " TL</h1></p>");

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
