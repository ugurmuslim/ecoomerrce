@extends('admin.layouts.admin')
@section('title', __('views.admin.product.create.title'))


@section('content')

  <div class="row ml-5">
    <input class="barcode-dimensions-input ml-5" id="barcode-font" type="text" name="" value="15">Yazı Büyüklüğü</input>
    <input class="barcode-dimensions-checkbox ml-5" type="checkbox" id="price" checked>Fiyat Gösterilsin mi?</input>
    <input class="barcode-dimensions-checkbox ml-5" type="checkbox" id="barcode-name" >İsim Gösterilsin mi?</input>
    <input class="barcode-dimensions-checkbox ml-5" type="checkbox" id="barcode-category" checked>Kategori Gösterilsin mi?</input>

  </div>

  <div class="row">
    <div class="col-md-8 col-md-offset-2">

      {!! Form::model($product,['route' => ['stockentry.add_entry',$product->slug],'class'=>'form','data-parsley-validate' => '','method' => 'PUT']) !!}

      <div class="row">
        <div class="col-md-3">

          {{ Form::label('created_at','Stok Giriş Tarihi',['class'=>'form-spacing-top']) }}
          {{ Form::date('created_at',Carbon\Carbon::today(),['class'=>'form-control','required' => '','data-parsley-type' => 'number',])}}

        </div>

        <div class="col-md-3">

          {{ Form::label('created_at_hour','Stok Giriş Saati (Sa:Dk:Sn)',['class'=>'form-spacing-top']) }}
          {{ Form::text('created_at_hour',Carbon\Carbon::now()->format('H:i:s'),['class'=>'form-control','required' => '','step'=>'any','name' =>'created_at_hour'])}}
        </div>
      </div>
      {{ Form::label('id','Ürün No:',['class'=>'form-spacing-top']) }}
      {{ Form::text('id',$product->product_id,['class'=>'form-control ','disabled'=>''])}}

      {{ Form::label('name','Ürün İsmi:',['class'=>'form-spacing-top']) }}
      {{ Form::text('name',null,['class'=>'form-control ','disabled'=>''])}}


      {{ Form::label('entry_price','Giriş Fiyatı:(TL)',['class'=>'form-spacing-top']) }}
      {{ Form::number('entry_price',null,['class'=>'form-control','required' => '','step'=>'any'])}}

      @php
        $size_old_id = null;
        $i = 0;
      @endphp
        <div class="row">
          @foreach($product->sizes as $size)
        @if($size->id !== $size_old_id)
            <div class="col-md-3">
              <h3><strong>{{$size->attribute_long}}</strong></h3>

            <table class="table">
              <thead>
                <tr>
                <th>Renk</th>
                <th>Miktar</th>
                <th>Barkod</th>
              </tr>
              </thead>
              <tbody>
                @foreach($product->colors()->where('size_id',$size->id)->get() as $color)
                  <tr>
                <td>{{$color->attribute_long}}</td>
                <td>{{ Form::number("stock_attributes[$size->id][$color->id]",null,['class'=>'form-control size','step'=>'any'])}}</td>
                <td>@include('partials._modal_print')</td>
                  </tr>
                @endforeach
                <tbody>
            </table>
          </div>
        @endif
          @php
          $size_old_id = $size->id;
          $i++

          @endphp
        @endforeach

        </div>
        <div class="row ">
          <div class="col-md-3">
            {{ Form::label('size','Beden :',['class'=>'form-spacing-top ']) }}
            <select class="form-control select2 size_options" style="height:45%;" name="size_id">
              @foreach($attributes->where('attribute_id',2) as $attribute )
                <option value="{{$attribute->id}}">{{$attribute->attribute_long}}</option>
              @endforeach
            </select>
          </div>

          <div class="col-md-3">
            {{ Form::label('color','Renk :',['class'=>'form-spacing-top ']) }}
            <select class="form-control select2 color_options" style="height:45%;" name="color_id">
              @foreach($attributes->where('attribute_id',1) as $attribute )
                <option value="{{$attribute->id}}">{{$attribute->attribute_long}}</option>
              @endforeach
            </select>
          </div>
          <div class="col-md-2">
            {{ Form::label('quantity','Miktar :',['class'=>'form-spacing-top ']) }}
            {{ Form::number('quantity',null,['class'=>'form-control quantity_variation'])}}
          </div>
          <div class="col-md-2 mt-5">
            <button type="button" name="button" class="add_variation btn btn-success" style="margin-top:55px;">Ekle</button>
          </div>
          </div>
        <table class="table">
          <thead>
            <tr>
              <th style="width:1%;">#</th>
              <th>Beden</th>
              <th>Renk</th>
              <th>Miktar</th>
            </tr>
          </thead>
          <tbody class="table_rows">
          </tbody>
        </table>
{{Form::submit('Kaydet',['class' => 'btn btn-success btn-block form-spacing-top']) }}
{{Form::close() }}
</div>
</div>

@endsection
@section('scripts')
@parent
{{ Html::script(mix('assets/common/js/parsley.min.js')) }}
<script type="text/javascript">
var $table_rows = $('.table_rows');
  $i = 0;
    $('.add_variation').on('click',function(){
      $i = $i+1;
var $size_val = $('.size_options :selected').val();
var $size_html = $('.size_options :selected').html();
var $color_val = $('.color_options :selected').val();
var $color_html = $('.color_options :selected').html();
var $quantity_variation = $('.quantity_variation').val();
console.log($quantity_variation);
var input = '<tr class="table_row" id=' + $i + '>' +
'<td><button type="button" class="close" style = "font-size:30px;" aria-label="Close"><span aria-hidden="true">&times;</span></button></td>' +
'<td class="product_size"><input type="text" name="product_size_id['+$size_val+']" value ="'+  $size_html +'" readonly></td>' +
'<td class="product_size"><input type="text" name="product_color_id['+$size_val+']" value ="'+  $color_html +'" readonly></td>' +
'<td class="product_color"><input type="text" name="product_quantity['+$size_val+']" style="width:40px;" value ="'+  $quantity_variation +' "readonly></input></td>' +
'<td class="product_size"><input type="text" name="stock_attributes['+$size_val+']['+$color_val+']" value ="'+  $quantity_variation +'"hidden></td>' +
'</tr>'
$(input).prependTo($table_rows)
$('.quantity_variation').val('');
})
$(document).on('click','.close', function(){
$(this).closest('tr').remove();
})
</script>
@endsection
