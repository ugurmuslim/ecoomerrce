@extends('admin.layouts.admin')
@section('title', __('views.admin.product.index.title'))
@section('content')
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
