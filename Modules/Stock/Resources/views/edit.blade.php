@extends('admin.layouts.admin')
@section('title', __('views.admin.product.create.title'))
@section('content')
    <div class="row">
      <div class="col-md-8 col-md-offset-2">

        {!! Form::model($product,['route' => ['stockentry.update',$product->slug],'method' => 'PUT']) !!}


        <div class="row">
          <div class="col-md-3">

            {{ Form::label('created_at','Stok Giriş Tarihi',['class'=>'form-spacing-top']) }}
            {{ Form::date('created_at',Carbon\Carbon::today(),['class'=>'form-control','required' => '','data-parsley-type' => 'number',])}}
          </div>

          <div class="col-md-4">

            {{ Form::label('created_at_hour','Stok Giriş Saati (Sa:Dk:Sn)',['class'=>'form-spacing-top']) }}
            {{ Form::text('created_at_hour',Carbon\Carbon::now()->format('H:i:s'),['class'=>'form-control','required' => '','step'=>'any','name' =>'created_at_hour'])}}
          </div>
        </div>

        {{ Form::label('name','Ürün İsmi:',['class'=>'form-spacing-top']) }}
        {{ Form::text('name',null,['class'=>'form-control ','disabled'=>''])}}

        @php
          $size_old_id = null;
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
                  <td>{{ Form::number("stock_attributes[$size->id][$color->id]",$color->pivot->stock,['class'=>'form-control size','step'=>'any'])}}</td>
                  <td><a href="{{route('products.edit',$product->id)}}" class="btn btn-sm btn-primary">Barkod</a></td>
                    </tr>
                  @endforeach
                  <tbody>
              </table>
            </div>
          @endif
            @php
            $size_old_id = $size->id;

            @endphp
          @endforeach

        {{Form::submit('Kaydet',['class' => 'btn btn-success btn-block form-spacing-top']) }}
        {{Form::close() }}

      </div>
    </div>
  </div>
</div>

@endsection
