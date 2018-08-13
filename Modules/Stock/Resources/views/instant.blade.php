@extends('admin.layouts.admin')
@section('title', __('views.admin.admin.instant.entry'))
@section('styles')
  {{ Html::style(mix('assets/common/css/select2.min.css')) }}
  @section('content')
    <div class="row">
      <div class="col-md-8 col-md-offset-2">

        {!! Form::open(['route'=>['stockentry.instant_store'],'class'=>'form','data-parsley-validate' => '']) !!}


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

        {{ Form::label('name','Ürün İsmi:',['class'=>'form-spacing-top']) }}
        {{ Form::text('name',null,['class'=>'form-control name','required' => ''])}}

        {{ Form::label('details','Ürün Açıklaması:',['class'=>'form-spacing-top']) }}
        {{ Form::textarea('details',null,['class'=>'form-control name','required' => ''])}}

        {{ Form::label('category_id','Kategori İsmi:',['class'=>'form-spacing-top']) }}
        <select class="category form-control select2" style="height:40px;" name="category_id">
          @foreach($categories as $category)
            <option class="cat" value='{{ $category->id }}' @if(old('category_id') == $category->id) selected @endif>{{ $category->name }}</option>
            @endforeach
          </select>

          {{ Form::label('entry_price','Giriş Fiyatı:',['class'=>'form-spacing-top']) }}
          {{ Form::number('entry_price',null,['class'=>'form-control','step'=>'any','required' => '','data-parsley-type' => 'number'])}}

          {{ Form::label('price','Satış Fiyatı:',['class'=>'form-spacing-top']) }}
          {{ Form::number('price',null,['class'=>'form-control','step'=>'any','required' => '','data-parsley-type' => 'number'])}}

          {{ Form::label('unit_id','Birim:',['class'=>'form-spacing-top']) }}
          <select class="form-control select2" style="height:40px;" name="unit_id">
            @foreach($units as $unit)
              <option value='{{ $unit->id }}'>{{ $unit->name }}</option>
            @endforeach
          </select>

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
      {{ Html::script(mix('assets/common/js/select2.min.js')) }}
      <script type="text/javascript">
        $('.select2').select2();
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
