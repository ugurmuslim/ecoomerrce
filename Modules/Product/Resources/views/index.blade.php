@extends('admin.layouts.admin')
@section('title', __('views.admin.product.index.title'))

@section('content')
  <div class="row">
    <div class="col-md-8 col-md-offset-2">
      <button type="button" name="button" class="btn btn-primary btn-block sale-details-button">Ürünler Genel Bilgiler</button>
    </div>
  </div>
  {{--  <div class="well text-center slide-panels">
  <div class="row">
  <div class="col-md-12">
  <p><button type="button" name="button" class="btn btn-default" style="width:600px;"><h4>Mevcut Ürün Çeşidi:  {{ count($products)}} Adet</h4></button></p>
  <p><button type="button" name="button" class="btn btn-default" style="width:600px;"><h4>Kategori Çeşidi:  {{ count($products->groupBy('category_id'))}} Adet</h4></button></p>
  <p><button type="button" name="button" class="btn btn-default" style="width:600px;"><h4>Ürün Toplam Miktarı:  {{ $stocks->sum('stock') }} Adet</h4></button></p>
</div>
</div>
</div>
--}}
<div class="row">

  <div class="col-md-12">
    <table class="table" id="table">
      <thead>
        <tr>
          <th>Kod</th>
          <th>İsim</th>
          <th>Barkod No</th>
          <th>Beden</th>
          <th>Renk</th>
          <th>Kategori</th>
          <th>Miktar</th>
          <th>Birim</th>
          <th>Fiyat</th>
          <td></td>
        </tr>
      </thead>
      <tbody>
        @php
        $i = 0;
        $attr_old_id = null;
        @endphp
        @foreach($products as $product)
          @foreach($product->sizes as $size)
              <tr>
                <th><a href="{{route('products.show',$product->slug)}}">{{ $product->product_id }}</a></th>
                <td><a href="{{route('products.show',$product->slug)}}">{{ $product->name }}</a></td>
                <td>{{ $product->product_id.$size->id }}</td>
                <td>{{ $size->attribute_long }} </td>
                <td> {{ $product->colors()->where('color_id',$size->pivot->color_id)->first()->attribute_long}} </td>
                <td>{{ $product->category->name }}</td>
                <td>{{ $size->pivot->stock }}</td>
                <td> Birim</td>
                <td>{{ $product->price }} TL</td>
              </tr>
          @endforeach
        @endforeach

      </tbody>
    </table>
    {{ $products->links() }}

  </div>
</div>

@endsection
