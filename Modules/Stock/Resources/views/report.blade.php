@extends('admin.layouts.admin')
@section('title', __('views.admin.stockentry.report_title'))
@section('content')
  @php
  $packages = $stockentries->groupBy('package');
  $total = $stockentries->sum('price');
@endphp
<div class="row">
  <div class="col-md-8 col-md-offset-2">
    <button type="button" name="button" class="btn btn-primary btn-block sale-details-button">Stok Hareket Dtayları</button>
  </div>
</div>
<div class="well text-center slide-panels">
  <div class="row">
    <div class="col-md-6">
      @foreach($stockentries->groupBy('category_id') as $category)
        <p><button type="button" name="button" class="btn btn-default"><h4>{{number_format($category->sum('quantity'))}} Adet {{  Modules\Category\Entities\Category::find($category[0]->category_id)->name }}
          Toplam Giriş : {{number_format($category->sum(function ($x) {
            return  $x->entry_price * $x->quantity;
          }))}} TL</h4></button></p>
        @endforeach
      </div>
    </div>
    <div class="row">
      <div class="col-md-8 col-md-offset-2">
        <p><h1>Genel Toplam : {{ number_format($total) }} TL</h1></p>
      </div>
    </div>
  </div>
<div class="row form-spacing-top">
  <div class="col-md-12">
    @foreach($packages as $package_id=>$details)
      <dl class="row" style="background-color:#000030; color:white; ">
        <dd class="col-md-2"><h5><strong>Tip : {{ $details[0]->stockmovement->name }}</strong></h5></dd>
        <dd class="col-md-2"><h5><strong>Toplam : {{number_format($details->sum(function ($x) {
          return  $x->entry_price * $x->quantity;
        }),2)}} TL</strong></h5></dd>
        <dd class="col-md-2"><h5><strong>Tarih :{{ Carbon\Carbon::parse($details[0]->created_at)->format('d/m/Y  H:i')}}</strong></h5></dd>
        <dd class="col-md-6">
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
              <th>Hareket Fiyatı</th>
            </tr>
          </thead>
          <tbody>
            @foreach($details as $detail)
              <tr>
                <th><a href="{{route('products.show',$detail->product->slug)}}">{{ $detail->product->product_id }}</a></th></a></th>
                <th><a href="{{route('products.show',$detail->product->slug)}}">{{ $detail->product->name }} </a></th>
                <th class="phone_not_display">{{ $detail->size->attribute_long }} </a></th>
                <th class="phone_not_display">{{ $detail->color->attribute_long }}</th>
                <th class="phone_not_display">{{ $detail->product->category->name }}</th>
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

@section('admin_scripts')
  <script type="text/javascript">
    console.log('sda');
  </script>
  @include('partials._slide_panel_javascript')

@endsection
