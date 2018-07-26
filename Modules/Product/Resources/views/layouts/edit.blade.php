@extends('admin.layouts.admin')
@section('title', __('views.admin.product.create.title'))
@section('content')
@section('stylesheets')
  {!! Html::style('css/parsley.css') !!}
@endsection
@section('content')

    <div class="row">
      <div class="col-md-8 col-md-offset-2">
        <h1><strong>Ürün Güncelleme</strong></h1>

{!! Form::model($product,['route' => ['products.update',$product->id],'data-parsley-validate' => '' ,'method' => 'PUT']) !!}

{{ Form::label('name','Ürün İsmi:',['class'=>'form-spacing-top']) }}
{{ Form::text('name',null,['class'=>'form-control','required' => ''])}}

{{ Form::label('category_id','Kategori İsmi: (Kategori Değiştirecekseniz Ürünü Silip Yeniden Yaratmalısınız)',['class'=>'form-spacing-top']) }}
{{ Form::select('category_id',$categories,null,['class' => 'form-control','disabled'=>'','style' =>'height:40px;'])}}

{{ Form::label('price','Satış Fiyatı:',['class'=>'form-spacing-top']) }}
{{ Form::number('price',null,['class'=>'form-control','step'=>'any','required' => '','data-parsley-type' => 'number'])}}

{{ Form::label('unit_id','Birim:',['class'=>'form-spacing-top']) }}
{{ Form::select('unit_id',$units,null,['class' => 'form-control','style' =>'height:40px;'])}}

{{--  <div class="row mt-5 sizes">

    <div class="col-md-12">

      <input type="checkbox" name="size_price" class="size_price" id="checkbox" value="1"  checked=""> Her bir Bedenin Fiyatı Aynı mı?</input>
    </div>
    @foreach($sizes as $size)
    <div class="col-md-3">
      {{ Form::label('price_size',"$size->desc Fiyat:",['class'=>'form-spacing-top']) }}
      {{ Form::text("price_size[$size->id]",$size->pivot->price_size,['class'=>'form-control size'])}}

    </div>

  @endforeach

  </div>

--}}
{{Form::submit('Kaydet',['class' => 'btn btn-success btn-block form-spacing-top']) }}
{{Form::close() }}

    </div>
  </div>

@endsection
@section('scripts')
{!! Html::script('js/parsley.min.js') !!}
{!! Html::script('js/i18n/tr.js') !!}
@endsection
