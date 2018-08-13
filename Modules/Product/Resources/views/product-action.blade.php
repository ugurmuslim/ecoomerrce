@extends('admin.layouts.admin')
@section('title', __('views.admin.product.create.title'))
@section('content')
    <div class="row">
      <div class="col-md-8 col-md-offset-2">
{!! Form::open(['route'=>['products.setAction']]) !!}

{{ Form::label('name_id','Ürün Numarası/Ürün İsmi:',['class'=>'form-spacing-top']) }}
{{ Form::text('name_id',null,['class'=>'form-control','placeholder'=>'Ürün İsim veya Numarasını Giriniz'])}}

{{Form::submit('Değiştir',['class' => 'btn btn-success btn-block form-spacing-top','name' =>'name']) }}
{{Form::submit('Stok Gir',['class' => 'btn btn-warning btn-block form-spacing-top','name' =>'name']) }}
{{Form::submit('Görüntüle',['class' => 'btn btn-danger btn-block form-spacing-top','name' =>'name']) }}
{{Form::close() }}
    </div>
  </div>

@endsection
