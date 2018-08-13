@extends('admin.layouts.admin')
@section('title','ÜRÜN DEĞİŞTİRME |')
@section('content')
    <div class="row">
      <div class="col-md-8 col-md-offset-2">

{!! Form::model($product,['route' => ['products.update',$product->id],'data-parsley-validate' => '' ,'method' => 'PUT']) !!}

{{ Form::label('name','Ürün İsmi:',['class'=>'form-spacing-top']) }}
{{ Form::text('name',null,['class'=>'form-control','required' => ''])}}

{{ Form::label('details','Açıklama',['class'=>'form-spacing-top']) }}
{{ Form::textarea('details',null,['class'=>'form-control name','required' => ''])}}

{{ Form::label('category_id','Kategori İsmi: (Kategori Değiştirecekseniz Ürünü Silip Yeniden Yaratmalısınız)',['class'=>'form-spacing-top']) }}
{{ Form::select('category_id',$categories,null,['class' => 'form-control','style' =>'height:40px;'])}}

{{ Form::label('price','Satış Fiyatı:',['class'=>'form-spacing-top']) }}
{{ Form::number('price',null,['class'=>'form-control','step'=>'any','required' => '','data-parsley-type' => 'number'])}}

{{ Form::label('unit_id','Birim:',['class'=>'form-spacing-top']) }}
{{ Form::select('unit_id',$units,null,['class' => 'form-control','style' =>'height:40px;'])}}

{{Form::submit('Kaydet',['class' => 'btn btn-success btn-block form-spacing-top']) }}
{{Form::close() }}

    </div>
  </div>

@endsection
