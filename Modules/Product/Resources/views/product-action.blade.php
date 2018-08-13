@extends('admin.layouts.admin')
@section('title', __('views.admin.product.action.title'))
@section('content')
    <div class="row">
{!! Form::open(['route'=>['products.setAction']]) !!}

{{ Form::label('name_id','Ürün Numarası/Ürün İsmi:',['class'=>'form-spacing-top']) }}
{{ Form::text('name_id',null,['class'=>'form-control','placeholder'=>'Ürün İsim veya Numarasını Giriniz'])}}

{{Form::submit('Değiştir',['class' => 'btn btn-success  form-spacing-top','name' =>'name']) }}
{{Form::submit('Görüntüle',['class' => 'btn btn-danger  form-spacing-top','name' =>'name']) }}
{{Form::submit('Stok Gir',['class' => 'btn btn-warning  form-spacing-top','name' =>'name']) }}
{{Form::submit('Stok Düzeltme',['class' => 'btn btn-defult  form-spacing-top','name' =>'name']) }}
{{Form::close() }}
  </div>

@endsection
